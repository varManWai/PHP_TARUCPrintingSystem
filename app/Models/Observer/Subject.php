<?php

abstract class Subject {
  private $observers;
  
  function __construct() {
    $this->observers = new SplObjectStorage();
  }
  
  public function attach($RptObserver) {
    $this->observers->attach($RptObserver);
  }
  
  public function notifyAllObservers() {
    foreach ($this->observers as $observer) {
      $observer->update();
    }
  }


}
