<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $userID;
    private $cartID;
    
    public function index(){
        if(!auth()->user()){
            return view('orders.noUser');
        }
        
        $id = Auth::user()->id;
        $programmeID = DB::table('users')
        ->select('programmeID')
        ->where('id','=',$id)
        ->get();
        $programmeID = json_decode( json_encode($programmeID), true);
        $programmeID = $programmeID[0]['programmeID'];
        
        
        $subjectID = DB::table('programmesubject')
        ->select('subjectID')
        ->where('programmeID','=', $programmeID)
        ->get();
       
        return view('orders.index')
        ->with('subjectIDs',$subjectID);
        
        
    }
    
    public function addCart(){
        
        return redirect()->back();
    }
    
    
}

class OrderFacade{
    private $cart;
    private $payment;
    private $createOrder;
    
    function __construct(){
        $this->cart = new Cart();
        $this->payment = new Payment();
        $this->createOrder = new CreateOrder();
    }
    
    
}

class CreateOrder{
    
}

class Payment{
    
}

class Cart{
    
    function createUserCart($id){
        $cartID = DB::table('cart')->insertGetId(
            ['userID' => $id ]
        );
        return $cartID;
    }
    
    function addSubjectCart($cartID,$subjectID,$id){
        $cartID = DB::table('cart')
        ->select('cartID')
        ->where('userID','=',$id)
        ->get();
        
        if(is_null($cartID)){
            $cartID = createUserCart($id);
        }
        
        $subjectQuantity = DB::table('cart_subject')
        ->select('Quantity')
        ->where('subjectID', '=', $subjectID)
        ->get();
        
        if(is_null($subjectQuantity)){
            DB::table('cart_subject')->insert([
                'cartID'    => $cartID,
                'subjectID' => $subjectID,
                'Quantity'  => 1
            ]);
        }else{
            DB::table('cart_subject')
            ->where('cartID','=',$cartID)
            ->where('subjectID','=', $subjectID)
            ->increment('Quantity');
        }
        
    }
    
    function deleteCart(){
        
    }
}
