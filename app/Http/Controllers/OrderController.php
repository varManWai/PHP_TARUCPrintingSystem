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
        
        $orderFacade = new OrderFacade();

        $test = $orderFacade->returnTest();

        return view('orders.index')->with('test',$test);
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

    public function returnTest(){
        $test = $this->cart->test();
        return $test;
    }
    

}

class CreateOrder{

}

class Payment{

}

class Cart{
    
    function createUserCart($userID){
        
    }

    function test(){
        $test = "test";
        return $test;
    }

    function addSubjectCart($cartID,$subjectID){
        
    }

    function deleteCart(){

    }
}
