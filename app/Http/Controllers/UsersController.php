<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('admin.usersDashboard');

    }

    public function update(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phoneNo' => ['string', 'min:10', 'max:11', 'nullable'],
            'programmeID' => ['string', 'nullable'],
        ]);

        //UPDATE USER
        //GET the User 
        $user = User::find(Auth::user()->id);

        //ASSIGN the new data to the user 
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make(trim($request->password));
        $user->phoneNo = trim($request->phoneNo);
        $user->programmeID = trim($request->programmeID);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Profile updated');

    }

    public function edit(Request $request)
    {

        return view('users.editUser');
    }
}

// interface AccountInterface{
//     function loginAcc($email,$password);
// }

// class BaseAcc {
//     private $name;
//     private $phoneNo;
//     private $email;
//     private $password;
//     private $timeStamp;

//     public function __construct($name="",$phoneNo="",$email="",$password="",$timeStamp="")
//     {
//         $this->name = $name;
//         $this->phoneNo = $phoneNo;
//         $this->email = $email;
//         $this->password = $password;
//         $this->timeStamp = $timeStamp;
//     }

//     public function loginAcc($email,$password){
//         dd('never used');

//     }

//     public function getName()
//     {
//         return $this->name;
//     }
//     public function setName($name)
//     {
//         $this->name = $name;
//     }

//     public function getPhoneNo()
//     {
//         return $this->phoneNo;
//     }
//     public function setPhoneNo($phoneNo)
//     {
//         $this->phoneNo = $phoneNo;
//     }

//     public function getEmail()
//     {
//         return $this->email;
//     }
//     public function setEmail($email)
//     {
//         $this->email = $email;
//     }

//     public function getPassword()
//     {
//         return $this->password;
//     }
//     public function setPassword($password)
//     {
//         $this->password = $password;
//     }

//     public function getTimeStamp()
//     {
//         return $this->timeStamp;
//     }
//     public function setTimeStamp($timeStamp)
//     {
//         $this->timeStamp = $timeStamp;
//     }
// }

// class AccDecorator {

// }

// class StudentAcc extends AccDecorator{

// }

// class AdminAcc extends AccDecorator{

// }

// class SupplierAcc extends AccDecorator{

// }
