<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index(){
        return view('orders.index');
    }

    public function addCart(){
        
        
    }

    
}

class OrderFacade{
    
}

class CreateOrder{

}

class Payment{

}

class Cart{
    
    public function createUserCart($userID){
        
    }

    public function addSubjectCart($cartID,$subjectID){
        
    }

    public function deleteCart(){

    }
}
