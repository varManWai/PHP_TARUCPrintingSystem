<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(){
        return view('report.report');
    }
    
    public function generateDaily(){
        $totalSales = 0;
        $NumberOfSales = 0;
        $averageRevenuePerSales = 0;
        $highestSalesOfTheDay = 0;
        $dates = date("Y-m-d");
        $day = date("d");
        
        
        $orderData = DB::table('order')->select('totalPrice','date')->get();
        
        if($orderData->isEmpty()){
            return view('report.print')->with('order','Empty');
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
                return view('report.print')->with('order','Available')->with('numberOfSales',$NumberOfSales)->with('date',$dates)->with('type',0);
                
            }else{
                
                $averageRevenuePerSales = number_format(($totalSales/$NumberOfSales),2);
                $highestSalesOfTheDay = number_format($highestSalesOfTheDay,2);
                $totalSales = number_format($totalSales,2);
                $subjectData = DB::Table('subject')->leftJoin('order_subject','subject.subjectID','=','order_subject.subjectID')->leftJoin('order','order.orderID','=','order_subject.orderID')->where('order.date','=',$dates)->select('subject.subjectID','subject.courseCode','subject.title',DB::raw('SUM(order_subject.Quantity) AS Quantity'))->groupBy('subject.subjectID','subject.courseCode','subject.title')->get();
                
                return view('report.print')->with('order','Available')->with('totalSales',$totalSales)->with('numberOfSales',$NumberOfSales)->with('averagePerSales',$averageRevenuePerSales)->with('highestSales',$highestSalesOfTheDay)->with('date',$dates)->with('subjectDetails',$subjectData)->with('type',0);
                
            }
        }
        
    }
    
    
    public function generateMonthly(){
        
        $totalSales = 0;
        $NumberOfSales = 0;
        $averageRevenuePerSales = 0;
        $averageRevenuePerDay = 0;
        $highestSalesOfTheMonth = 0;
        
        $dates = date("Y-m-d");
        $month = date("n");
        $year = date("Y");
        $dayMonth=cal_days_in_month(CAL_GREGORIAN,$month,$year);
        
        $orderData = DB::table('order')->select('totalPrice','date')->get();
        
        if($orderData->isEmpty()){
            return view('report.print')->with('order','Empty');
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
                return view('report.print')->with('order','Available')->with('numberOfSales',$NumberOfSales)->with('date',$dates)->with('type',1);
                
            }else{
                
                $averageRevenuePerSales = number_format(($totalSales/$NumberOfSales),2);
                $highestSalesOfTheMonth = number_format($highestSalesOfTheMonth,2);
                $totalSales = number_format($totalSales,2);
                $averageRevenuePerDay = number_format(($totalSales/$dayMonth),2);
                
                $subjectData = DB::Table('subject')->leftJoin('order_subject','subject.subjectID','=','order_subject.subjectID')->leftJoin('order','order.orderID','=','order_subject.orderID')->where(DB::raw('MONTH(order.date)'),'=',$month)->where(DB::raw('YEAR(order.date)'),'=',$year)->select('subject.subjectID','subject.courseCode','subject.title',DB::raw('SUM(order_subject.Quantity) AS Quantity'))->groupBy('subject.subjectID','subject.courseCode','subject.title')->get();
                
                return view('report.print')->with('order','Available')->with('totalSales',$totalSales)->with('numberOfSales',$NumberOfSales)->with('averagePerSales',$averageRevenuePerSales)->with('averagePerDay',$averageRevenuePerDay)->with('highestSales',$highestSalesOfTheMonth)->with('date',$dates)->with('subjectDetails',$subjectData)->with('type',1);
                
            }
            
            
        }
    }
    
    public function generateYearly(){
        $totalSales = 0;
        $NumberOfSales = 0;
        $averageRevenuePerSales = 0;
        $averageRevenuePerDay = 0;
        $averageRevenuePerMonth = 0;
        $highestSalesOfTheYear = 0;
        
        $dates = date("Y-m-d");
        $year = date("Y");
        
        $orderData = DB::table('order')->select('totalPrice','date')->get();
        
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
            return view('report.print')->with('order','Available')->with('numberOfSales',$NumberOfSales)->with('date',$dates)->with('type',2);
            
        }else{
            
            $averageRevenuePerSales = number_format(($totalSales/$NumberOfSales),2);
            $averageRevenuePerDay = number_format(($totalSales/365),2);
            $averageRevenuePerMonth = number_format(($totalSales/12),2);
            $highestSalesOfTheYear = number_format($highestSalesOfTheYear,2);
            $totalSales = number_format($totalSales,2);
            
            
            $subjectData = DB::Table('subject')->leftJoin('order_subject','subject.subjectID','=','order_subject.subjectID')->leftJoin('order','order.orderID','=','order_subject.orderID')->where(DB::raw('YEAR(order.date)'),'=',$year)->select('subject.subjectID','subject.courseCode','subject.title',DB::raw('SUM(order_subject.Quantity) AS Quantity'))->groupBy('subject.subjectID','subject.courseCode','subject.title')->get();
            
            return view('report.print')->with('order','Available')->with('totalSales',$totalSales)->with('numberOfSales',$NumberOfSales)->with('averagePerSales',$averageRevenuePerSales)->with('averagePerDay',$averageRevenuePerDay)->with('averagePerMonth',$averageRevenuePerMonth)->with('highestSales',$highestSalesOfTheYear)->with('date',$dates)->with('subjectDetails',$subjectData)->with('type',2);
            
        }
    }

    
}




abstract class observer{
    protected $subject;
    public abstract function update();
}

class report extends subjectObserver{
    private $totalSales;
    private $numberOfSales;
    private $totalSalesToday;
    private $numberOfSalesToday;
    private $averageRevenuePerSales;
    private $highestSalesOfTheDay;
    
    public function __construct($totalSales, $numberOfSales, $totalSalesToday, 
    $numberOfSalesToday, $averageRevenuePerSales, 
    $highestSalesOfTheDay)
    {
        $this->totalSales = $totalSales;
        $this->numberOfSales = $numberOfSales;
        $this->totalSalesToday = $totalSalesToday;
        $this->numberOfSalesToday = $numberOfSalesToday;
        $this->averageRevenuePerSales = $averageRevenuePerSales;
        $this->highestSalesOfTheDay = $highestSalesOfTheDay;
        
    }
    
    public function getTotalSales() {
        return $this->totalSales;
    }
    
    public function setTotalSales($totalSales) {
        $this->totalSales = $totalSales;
    }
    
    public function getNumberOfSales() {
        return $this->numberOfSales;
    }
    
    public function setNumberOfSales($numberOfSales) {
        $this->numberOfSales = $numberOfSales;
    }
    
    public function getTotalSalesToday() {
        return $this->totalSalesToday;
    }
    
    public function setTotalSalesToday($totalSalesToday) {
        $this->totalSalesToday = $totalSalesToday;
    }
    
    public function getNumberOfSalesToday() {
        return $this->numberOfSalesToday;
    }
    
    public function setnumberOfSalesToday($numberOfSalesToday) {
        $this->numberOfSalesToday = $numberOfSalesToday;
    }
    
    public function getAverageRevenuePerSales() {
        return $this->averageRevenuePerSales;
    }
    
    public function setAverageRevenuePerSales($averageRevenuePerSales) {
        $this->averageRevenuePerSales = $averageRevenuePerSales;
    }
    
    public function getHighestSalesOfTheDay() {
        return $this->highestSalesOfTheDay;
    }
    
    public function setHighestSalesOfTheDay($highestSalesOfTheDay) {
        $this->highestSalesOfTheDay = $highestSalesOfTheDay;
    }
    
}

class subjectObserver{
    private $observers;
    
    function __construct() {
        $this->observers = new SplObjectStorage();
    }
    
    public function attach($ReportObserver) {
        $this->observers->attach($ReportObserver);
    }
    
    public function notifyObservers() {
        $this->observers->update();
    }
}

class ReportObserver extends observer{
    function __construct($subject) {
        $this->subject = $subject;
        $this->subject->attach($this);
    }
    
    public function calculation(){
        $this->subject->getTotalSales();
    }
    
    public function update() {
        $this->subject->getTotalSales();
    }
}
