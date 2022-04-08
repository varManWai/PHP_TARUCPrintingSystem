<?php
// Author:Lai Man Wai 

namespace App\Models\Decorator\Interfaces;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseAcc extends Model 
{
    private $name;
    private $phoneNo;
    private $email;
    private $password;
    private $timeStamp;

    use HasFactory;

    
}
