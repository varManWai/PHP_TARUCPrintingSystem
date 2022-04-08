<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    
    public function generateDaily(){

        if(!auth()->user()){
            return view('report.print')->with('auth',0);
        }

        $totalSales = 0;
        $NumberOfSales = 0;
        $averageRevenuePerSales = 0;
        $highestSalesOfTheDay = 0;
        $dates = date("Y-m-d");
        $day = date("d");
        
        
        $orderData = DB::table('order')->where('status','Completed')->select('totalPrice','date')->get();
        
        if($orderData->isEmpty()){
            return view('report.print')->with('auth','1')->with('order','Empty');
        }else{
            foreach($orderData as $datas){
                $date = $datas->date;
                $timestamp = strtotime($datas->date);
                $dayDB = date('d',$timestamp);
                if($day==$dayDB){
                    $totalSales += $datas->totalPrice;
                    $NumberOfSales++;
                    if($datas->totalPrice>$highestSalesOfTheDay){
                        $highestSalesOfTheDay = $datas->totalPrice;
                    }
                }
            }
            
            
            if($NumberOfSales == 0){
                return view('report.print')->with('auth','1')->with('order','Available')->with('numberOfSales',$NumberOfSales)->with('date',$dates)->with('type',0);
                
            }else{
                
                $averageRevenuePerSales = number_format(($totalSales/$NumberOfSales),2);
                $highestSalesOfTheDay = number_format($highestSalesOfTheDay,2);
                $totalSales = number_format($totalSales,2);
                $subjectData = DB::Table('subject')->leftJoin('order_subject','subject.subjectID','=','order_subject.subjectID')->leftJoin('order','order.orderID','=','order_subject.orderID')->where('order.date','=',$dates)->where('order.status','Completed')->select('subject.subjectID','subject.courseCode','subject.title',DB::raw('SUM(order_subject.Quantity) AS Quantity'))->groupBy('subject.subjectID','subject.courseCode','subject.title')->get();
                
                return view('report.print')->with('auth','1')->with('order','Available')->with('totalSales',$totalSales)->with('numberOfSales',$NumberOfSales)->with('averagePerSales',$averageRevenuePerSales)->with('highestSales',$highestSalesOfTheDay)->with('date',$dates)->with('subjectDetails',$subjectData)->with('type',0);
                
            }
        }
        
    }
    
    
    public function generateMonthly(){
        
        if(!auth()->user()){
            return view('orders.noUser');
        }

        $totalSales = 0;
        $NumberOfSales = 0;
        $averageRevenuePerSales = 0;
        $averageRevenuePerDay = 0;
        $highestSalesOfTheMonth = 0;
        
        $dates = date("Y-m-d");
        $month = date("n");
        $year = date("Y");
        $dayMonth=cal_days_in_month(CAL_GREGORIAN,$month,$year);
        
        $orderData = DB::table('order')->where('status','Completed')->select('totalPrice','date')->get();
        
        if($orderData->isEmpty()){
            return view('report.print')->with('auth','1')->with('order','Empty');
        }else{
            
            foreach($orderData as $datas){
                $date = $datas->date;
                $timestamp = strtotime($datas->date);
                $monthDB = date('n',$timestamp);
                if($month==$monthDB){
                    $totalSales += $datas->totalPrice;
                    $NumberOfSales++;
                    if($datas->totalPrice>$highestSalesOfTheMonth){
                        $highestSalesOfTheMonth = $datas->totalPrice;
                    }
                }
            }
            
            if($NumberOfSales == 0){
                return view('report.print')->with('auth','1')->with('order','Available')->with('numberOfSales',$NumberOfSales)->with('date',$dates)->with('type',1);
                
            }else{
                
                $averageRevenuePerSales = number_format(($totalSales/$NumberOfSales),2);
                $highestSalesOfTheMonth = number_format($highestSalesOfTheMonth,2);
                $totalSales = number_format($totalSales,2);
                $averageRevenuePerDay = number_format(($totalSales/$dayMonth),2);
                
                $subjectData = DB::Table('subject')->leftJoin('order_subject','subject.subjectID','=','order_subject.subjectID')->leftJoin('order','order.orderID','=','order_subject.orderID')->where('order.status','Completed')->where(DB::raw('MONTH(order.date)'),'=',$month)->where(DB::raw('YEAR(order.date)'),'=',$year)->select('subject.subjectID','subject.courseCode','subject.title',DB::raw('SUM(order_subject.Quantity) AS Quantity'))->groupBy('subject.subjectID','subject.courseCode','subject.title')->get();
                
                return view('report.print')->with('auth','1')->with('order','Available')->with('totalSales',$totalSales)->with('numberOfSales',$NumberOfSales)->with('averagePerSales',$averageRevenuePerSales)->with('averagePerDay',$averageRevenuePerDay)->with('highestSales',$highestSalesOfTheMonth)->with('date',$dates)->with('subjectDetails',$subjectData)->with('type',1);
                
            }
            
            
        }
    }
    
    public function generateYearly(){

        if(!auth()->user()){
            return view('orders.noUser');
        }

        $totalSales = 0;
        $NumberOfSales = 0;
        $averageRevenuePerSales = 0;
        $averageRevenuePerDay = 0;
        $averageRevenuePerMonth = 0;
        $highestSalesOfTheYear = 0;
        
        $dates = date("Y-m-d");
        $year = date("Y");
        
        $orderData = DB::table('order')->where('status','Completed')->select('totalPrice','date')->get();
        if($orderData->isEmpty()){
            return view('report.print')->with('auth','1')->with('order','Empty');
        }else{
            foreach($orderData as $datas){
                $date = $datas->date;
                $timestamp = strtotime($datas->date);
                $yearDB = date('Y',$timestamp);
                if($year==$yearDB){
                    $totalSales += $datas->totalPrice;
                    $NumberOfSales++;
                    if($datas->totalPrice>$highestSalesOfTheYear){
                        $highestSalesOfTheYear = $datas->totalPrice;
                    }
                }
                
            }
            
            if($NumberOfSales == 0){
                return view('report.print')->with('auth','1')->with('order','Available')->with('numberOfSales',$NumberOfSales)->with('date',$dates)->with('type',2);
                
            }else{
                
                $averageRevenuePerSales = number_format(($totalSales/$NumberOfSales),2);
                $averageRevenuePerDay = number_format(($totalSales/365),2);
                $averageRevenuePerMonth = number_format(($totalSales/12),2);
                $highestSalesOfTheYear = number_format($highestSalesOfTheYear,2);
                $totalSales = number_format($totalSales,2);
                
                
                $subjectData = DB::Table('subject')->leftJoin('order_subject','subject.subjectID','=','order_subject.subjectID')->leftJoin('order','order.orderID','=','order_subject.orderID')->where('order.status','Completed')->where(DB::raw('YEAR(order.date)'),'=',$year)->select('subject.subjectID','subject.courseCode','subject.title',DB::raw('SUM(order_subject.Quantity) AS Quantity'))->groupBy('subject.subjectID','subject.courseCode','subject.title')->get();
                
                return view('report.print')->with('auth','1')->with('order','Available')->with('totalSales',$totalSales)->with('numberOfSales',$NumberOfSales)->with('averagePerSales',$averageRevenuePerSales)->with('averagePerDay',$averageRevenuePerDay)->with('averagePerMonth',$averageRevenuePerMonth)->with('highestSales',$highestSalesOfTheYear)->with('date',$dates)->with('subjectDetails',$subjectData)->with('type',2);
                
            }
        }
    }
    
    
}




abstract class observer{
    protected $subjectObserver;
    public abstract function update();
}

class orders extends subjectObserver{
    private $orderID;
    private $totalPrice;
    private $date;
    private $userID;
    
    public function __construct($orderID, $totalPrice, $date, $userID)
    {
        $this->orderID = $orderID;
        $this->totalPrice = $totalPrice;
        $this->date = $date;
        $this->userID = $userID;
    }
    
    public function getOrderID() {
        return $this->orderID;
    }
    
    public function setOrderID($orderID) {
        $this->orderID = $orderID;
    }
    
    public function getTotalPrice() {
        return $this->totalPrice;
    }
    
    public function setTotalPrice($totalPrice) {
        $this->totalPrice = $totalPrice;
    }

    public function getDate() {
        return $this->date;
    }
    
    public function setDate($date) {
        $this->date = $date;
    }

    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
    public function callObservers(){
        $this->notifyObservers();
    }
    
}

class subjectObserver{
    private $observers;
    
    function __construct() {
        $this->observers = new \SplObjectStorage();
    }
    
    public function attach($observer) {
        $this->observers->attach($observer);
    }
    
    public function notifyObservers() {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}

class DailyObserver extends observer{
    function __construct($subjectObserver) {
        $this->subjectObserver = $subjectObserver;
        $this->subjectObserver->attach($this);
    }
    
    public function update() {
        $this->generateDaily();
    }
}

class MonthlyObserver extends observer{
    function __construct($subjectObserver) {
        $this->subjectObserver = $subjectObserver;
        $this->subjectObserver->attach($this);
    }
    
    public function update() {
        $this->generateMonthly();
    }
}


class YearlyObserver extends observer{
    function __construct($subjectObserver) {
        $this->subjectObserver = $subjectObserver;
        $this->subjectObserver->attach($this);
    }
    
    public function update() {
        $this->generateYearly();
    }
}

