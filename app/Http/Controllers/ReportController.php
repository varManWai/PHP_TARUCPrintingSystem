<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(){
        return view('report.report');
    }

    public function generateDaily(){
        $totalSales = 0;
        $NumberOfSales = 0;
        $day = date("d");
        $data = DB::table('order')
            ->select(
                'totalPrice',
                'date',
            )
            ->get();

        foreach($data as $datas){
            $date = $datas->date;
            $timestamp = strtotime($datas->date);
            $dayDB = date('d',$timestamp);
            if($day==$dayDB){
                $totalSales += $datas->totalPrice;
                $NumberOfSales++;
            }
        }
        return view('report.print')->with('order',$data)->with('date',$NumberOfSales);
    }

    public function generateMonthly(){
        $totalSales = 0;
        $NumberOfSales = 0;
        $month = date("m");
        $data = DB::table('order')
            ->select(
                'totalPrice',
                'date',
            )
            ->get();

        foreach($data as $datas){
            $date = $datas->date;
            $timestamp = strtotime($datas->date);
            $monthDB = date('m',$timestamp);
            if($month==$monthDB){
                $totalSales += $datas->totalPrice;
                $NumberOfSales++;
            }
        }
        return view('report.print')->with('order',$data)->with('date',$NumberOfSales);
    }

    public function generateYearly(){
        $totalSales = 0;
        $NumberOfSales = 0;
        $year = date("Y");
        $data = DB::table('order')
            ->select(
                'totalPrice',
                'date',
            )
            ->get();

        foreach($data as $datas){
            $date = $datas->date;
            $timestamp = strtotime($datas->date);
            $yearDB = date('Y',$timestamp);
            if(2022==$yearDB){
                $totalSales += $datas->totalPrice;
                $NumberOfSales++;
            }
        }
        return view('report.print')->with('order',$data)->with('date',$yearDB);
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
