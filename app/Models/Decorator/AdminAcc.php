<?php
// Author:Lai Man Wai 

class adminAcc extends AccDecorator
{
    private $adminID;
    private $programmeID;
    private $accStatus;

    public function __construct($adminID, $name, $phoneNo, $email, $password, $timestamp, $programmeID, $accStatus)
    {
        parent::__construct($name, $phoneNo, $email, $password, $timestamp);
        $this->adminID = $adminID;
        $this->programmeID = $programmeID;
        $this->accStatus = $accStatus;

        
    }

    public function loginAcc($email, $password)
    {
        
    }

    public function getStudentID()
    {
        return $this->adminID;
    }
    public function setStudentID($adminID)
    {
        $this->adminID = $adminID;
    }

    public function getProgrammeID()
    {
        return $this->programmeID;
    }
    public function setProgrammeID($programmeID)
    {
        $this->programmeID = $programmeID;
    }

    public function getAccStatus()
    {
        return $this->accStatus;
    }
    public function setAccStatus($accStatus)
    {
        $this->accStatus = $accStatus;
    }
}
