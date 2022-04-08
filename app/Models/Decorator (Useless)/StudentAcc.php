<?php
// Author:Lai Man Wai 

class StudentAcc extends AccDecorator
{
    private $studentID;
    private $programmeID;
    private $accStatus;

    public function __construct($studentID, $name, $phoneNo, $email, $password, $timestamp, $programmeID, $accStatus)
    {
        
        $this->studentID = $studentID;
        $this->programmeID = $programmeID;
        $this->accStatus = $accStatus;
    }

    public function loginAcc($email, $password)
    {
        
    }

    public function getStudentID()
    {
        return $this->studentID;
    }
    public function setStudentID($studentID)
    {
        $this->studentID = $studentID;
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
