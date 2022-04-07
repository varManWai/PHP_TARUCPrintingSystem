<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subject;
use App\Models\User;
use App\Models\cart;
use App\Models\cart_subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    
    public function index(){
        if(!auth()->user()){
            return view('orders.noUser');
        }
        
        $id = Auth::user()->id;
        
        $programmeID = User::select('programmeID')
        ->where('id',$id)->first()->toArray();
        
        
        
        // $programmeID = DB::table('users')
        // ->select('programmeID')
        // ->where('id','=',$id)
        // ->get();
        
        
        // $programmeID = json_decode( json_encode($programmeID), true);
        // $programmeID = $programmeID[0]['programmeID'];
        
        
        $subjectID = DB::table('programmesubject')
        ->where('programmeID','=', $programmeID['programmeID'])
        ->pluck('subjectID')
        ->toArray();
        
        return view('orders.index')
        ->with('subjectIDs',$subjectID);
        
    }
    
    public function addCart(Request $request){
        $id = Auth::user()->id;
        $orderFacade = new OrderFacade;
        $success = $orderFacade->insertCart($request->input('subjectID'),$id);
        
        return redirect()->back()->with('success', $success);
    }

    public function cartIndex(){
        if(!auth()->user()){
            return view('orders.noUser');
        }
        $id = Auth::user()->id;
        $subjectID = $this->findSubjectId($id);
        if(empty($subjectID)){
            return view('orders.noItemInCart');
        }
        return view('orders.cart')->with('subjectID',$subjectID);
    }

    public function addCartFromCart(Request $request){
        $id = Auth::user()->id;
        $orderFacade = new OrderFacade;
        $success = $orderFacade->insertCart($request->input('subjectID'),$id);

        $subjectID = $this->findSubjectId($id);
        if(empty($subjectID)){
            return view('orders.noItemInCart');
        }
        return view('orders.cart')->with('subjectID',$subjectID);
    }

    public function reduceCart(Request $request){
        $id = Auth::user()->id;
        $orderFacade = new OrderFacade;
        $subjectID = $request->input('subjectID');
        
        $success = $orderFacade->minusCart($subjectID,$id);
        
        $subjectID = $this->findSubjectId($id);
        if(empty($subjectID)){
            return view('orders.noItemInCart');
        }
        return view('orders.cart')->with('subjectID',$subjectID);
    }

    public function removeFromCart(Request $request){
        $id = Auth::user()->id;
        $orderFacade = new OrderFacade;
        $subjectID = $request->input('subjectID');
        
        $success = $orderFacade->deleteCart($subjectID,$id);

        $subjectID = $this->findSubjectId($id);
        if(empty($subjectID)){
            return view('orders.noItemInCart');
        }
        return view('orders.cart')->with('subjectID',$subjectID);
    }

    function findSubjectId($id){
        $orderFacade = new OrderFacade;
        $cartID = cart::select('cartID')
        ->where('userID',$id)
        ->first();
       

        
        if(is_null($cartID)){
            $cartID = $orderFacade->createUserCart($id);
        }else{
            $cartID = $cartID->value('cartID');
        }
        
        $subjectID = DB::table('cart_subject')
        ->select('subjectID','Quantity')
        ->where('cartID','=',$cartID)
        ->get()
        ->toArray();
        return $subjectID;
    }
    
    
}

class OrderFacade{
    private $createCart;
    private $payment;
    private $createOrder;
    
    function __construct(){
        $this->createCart = new createCart();
        $this->payment = new Payment();
        $this->createOrder = new CreateOrder();
    }
    
    public function createUserCart($id){
        $cartID = $this->createCart->createUserCart($id);
        return $cartID;
    }

    public function insertCart($subjectID,$id){
        $success = $this->createCart->addSubjectCart($subjectID,$id);
        return $success;
    }

    public function minusCart($subjectID,$id){
        
        $success = $this->createCart->minusCart($subjectID,$id);
        return $success;
        
    }

    public function deleteCart($subjectID,$id){
        $success = $this->createCart->removeCart($subjectID,$id);
        return $success;
    }
    
}

class CreateOrder{
    
}

class Payment{
    
}

class createCart{
    
    function createUserCart($id){
        $cartID = DB::table('cart')->insertGetId(
            ['userID' => $id ]
        );
        return $cartID;
    }
    
    function addSubjectCart($subjectID,$id){
        // $cart = cart::where('userID',$id)->first();
        
        
        $cart = DB::table('cart')
        ->where('userID','=',$id)
        ->select('cartID')
        ->get();
        
        
        
        if($cart->isEmpty()){
            $create = new createCart;
            $cartID = $this->createUserCart($id);
            
        }
        else{
            $cartID = $cart[0]->cartID;
        }
        
        $subjectQuantity = cart_subject::select('Quantity')
        ->where('cartID',$cartID)
        ->where('subjectID',$subjectID)
        ->first();
        
        // $subjectQuantity = DB::table('cart_subject')
        // ->select('Quantity')
        // ->where('subjectID', '=', $subjectID)
        // ->get();
        
        if(is_null($subjectQuantity)){
            DB::table('cart_subject')->insert([
                'cartID'    => $cartID,
                'subjectID' => $subjectID,
                'Quantity'  => 1
            ]);
            return $success = 'Added to Cart';
        }else{
            DB::table('cart_subject')
            ->where('cartID','=',$cartID)
            ->where('subjectID','=', $subjectID)
            ->increment('Quantity');
            return $success = 'Added to Cart';
        }
        
    }
    
    function minusCart($subjectID,$id){
        $cart = DB::table('cart')
        ->where('userID','=',$id)
        ->select('cartID')
        ->get();
        
        $cartID = $cart[0]->cartID; 
        DB::table('cart_subject')
        ->where('cartID','=',$cartID)
        ->where('subjectID','=', $subjectID)
        ->decrement('Quantity');
        
        $checkQty = DB::table('cart_subject')
        ->where('cartID','=',$cartID)
        ->where('subjectID','=',$subjectID)
        ->select('Quantity')
        ->get();
        
        $Qty = $checkQty[0]->Quantity;
        
        if(empty($Qty)){
            DB::table('cart_subject')
            ->where('cartID','=',$cartID)
            ->where('subjectID','=',$subjectID)
            ->delete();
            return $success = 'Subject removed';
        }

        return $success = 'Subject reduced';
    }

    function removeCart($subjectID,$id){
        $cart = DB::table('cart')
        ->where('userID','=',$id)
        ->select('cartID')
        ->get();
        $cartID = $cart[0]->cartID; 
        
        DB::table('cart_subject')
        ->where('cartID','=',$cartID)
        ->where('subjectID','=', $subjectID)
        ->delete();

        return $success = 'Deleted from cart';
    }
}
