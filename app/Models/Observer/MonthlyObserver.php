<?php
require_once 'RptObserver.php';

class MonthlyObserver extends RptObserver {
  
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

  public function calAverageSalesPerDay(){
    
  }
  
  public function update() {
    echo "Monthly: " . decbin($this->subject->getValue()) . "<br />";
  }

}
