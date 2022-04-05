<?php
require_once 'RptObserver.php';

class YearlyObserver extends RptObserver {
  
  function __construct($subject) {
    $this->subject = $subject;
    $this->subject->attach($this);
  }

  public function calNumberSales(){

  }

  public function calTotalSales(){

  }

  public function calAverageSales(){
    
  }

  public function calAverageSalesPerMonth(){
    
  }

  public function calAverageSalesPerDay(){
    
  }
  
  public function update() {
    echo "Yearly: " . decbin($this->subject->getValue()) . "<br />";
  }

}
