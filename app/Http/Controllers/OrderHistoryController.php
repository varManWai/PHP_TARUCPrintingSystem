<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\ArrayToXml\ArrayToXml;

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
            
            $this->createXMLfile($data);

            return view('users/orderHistory')->with('auth','1')->with('record',1)->with('data',$data);
        }
        
        
    }
    
    public function getOrderHistory($id){
        $orderData = DB::table('order')->where('userID',$id)->select('orderID','totalPrice','date','status','pickUpMethod')->get();
        
        return $orderData;
    }

    public function loadXML(){
        
        $xml = new \DOMDocument();
        $xml->load('xsl\orderHistory.xml');

        $xsl = new \DOMDocument();
        $xsl->load('xsl\orderHistories.xsl');

        $proc = new \XSLTProcessor();

        $proc->importStyleSheet($xsl);

        echo $proc->transformToXML($xml);
    }
    
    public function createXMLfile($datas){
        $filePath = '../public/xsl/orderHistory.xml';
        $dom     = new \DOMDocument('1.0', 'utf-8'); 
        $dom->appendChild($dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="orderHistories.xsl"'));
        $root      = $dom->createElement('orderHistories'); 
        
        for($i=0; $i<count($datas); $i++){
            
            $orderID        =  $datas[$i]->orderID;  
            $totalPrice     =  $datas[$i]->totalPrice;  
            $date           =  $datas[$i]->date;  
            $status         =  $datas[$i]->status;  
            $pickUpMethod   =  $datas[$i]->pickUpMethod;
            
            $orderHistory = $dom->createElement('orderHistory');

            $ID             =$dom->createElement('orderID', $orderID); 
            $orderHistory->appendChild($ID);
            
            $ordertotalPrice  = $dom->createElement('totalPrice', $totalPrice); 
            $orderHistory->appendChild($ordertotalPrice); 
            
            $orderDate   = $dom->createElement('date', $date); 
            $orderHistory->appendChild($orderDate); 
            
            $orderStatus    = $dom->createElement('status', $status); 
            $orderHistory->appendChild($orderStatus); 
            
            $orderMethod     = $dom->createElement('pickUpMethod', $pickUpMethod); 
            $orderHistory->appendChild($orderMethod); 
            
            $root->appendChild($orderHistory);
        }
        $dom->appendChild($root); 
        $dom->save($filePath); 
        
    }
}
