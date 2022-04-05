<?php

// namespace App\Models\Interfaces;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseAcc extends Model implements Account 
{

    use HasFactory;

    private $name;
    private $phoneNo;
    private $email;
    private $password;
    private $timeStamp;

    public function __construct($name="",$phoneNo="",$email="",$password="",$timeStamp="")
    {
        $this->name = $name;
        $this->phoneNo = $phoneNo;
        $this->email = $email;
        $this->password = $password;
        $this->timeStamp = $timeStamp;
    }

    public function loginAcc($email,$password){
        dd('never used');

    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPhoneNo()
    {
        return $this->phoneNo;
    }
    public function setPhoneNo($phoneNo)
    {
        $this->phoneNo = $phoneNo;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getTimeStamp()
    {
        return $this->timeStamp;
    }
    public function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }
}
