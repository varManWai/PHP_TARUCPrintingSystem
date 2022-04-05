<?php
require_once "Subject.php";

class Report extends Subject {
  private $orderID;
  private $totalPrice;
  private $date;
  
  public function __construct($orderID,$totalPrice,$date) {
    $this->orderID = $orderID;
    $this->totalPrice = $totalPrice;
    $this->date = $date;
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



  public function setValue($value) {
    $this->value = $value;
    $this->notifyAllObservers();
  }

}
