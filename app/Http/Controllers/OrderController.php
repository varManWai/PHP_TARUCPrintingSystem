<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subject;


class OrderController extends Controller
{
    private $studentID;
    private $cartID;

    public function index(){
        $subject = subject::all();
        return view('orders.index')->with('subjects',$subject);
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
    
    function createUserCart($studentID){
        $cartID = DB::table('cart')->insertGetId(
            ['studentID' => $studentID ]
        );
        return $cartID;
    }

    function addSubjectCart($cartID,$subjectID,$studentID){
        $cartID = DB::table('cart')
        ->select('cartID')
        ->where('studentID','=',$studentID)
        ->get();

        if($cartID == NULL){
            $cartID = createUserCart($studentID);
        }

        

    }

    function deleteCart(){

    }
}
