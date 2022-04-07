<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {

        if(!auth()->user()){
            return view('users/orderHistory')->with('auth','0')->with('record',0);
        }
        
        $id = Auth::user()->id;

        $data = $this->getOrderHistory($id);

        if($data->isEmpty()){
            return view('users/orderHistory')->with('auth','1')->with('record',0);
        }else{
            return view('users/orderHistory')->with('auth','1')->with('record',1)->with('data',$data);
        }
        
        
    }

    public function getOrderHistory($id){
        $orderData = DB::table('order')->where('userID',$id)->select('orderID','totalPrice','date','status','pickUpMethod')->get();
        
        return $orderData;
    }

}
