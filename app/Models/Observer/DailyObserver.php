<?php
require_once 'RptObserver.php';

class DailyObserver extends RptObserver {
  
  function __construct($subject) {
    $this->subject = $subject;
    $this->subject->attach($this);
  }

  public function calculation(){
    
  }

  public function calNumberSales(){

  }

  public function calTotalSales(){

  }

  public function calAverageSales(){
    
  }
  
  public function update() {
    echo "Daily: <br />";
  }

}
