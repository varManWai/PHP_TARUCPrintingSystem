<?php

class CreateOrder{
    private $orderID;
    private $totalPrice;
    private $date;
    private $status;
    private $pickUpMethod;
    private $subjectOrderID;

    public function __construct($orderID,){
        $this->orderID = $orderID;
    }

	public function getOrderID() {
		return this.$orderID;
	}

	private function setOrderID() {
		$this->orderID = $orderID;
	}

	



}