<?php
// Author:ChanOwen
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

    public function edit(Request $request)
    {

        return view('users.editUser');
    }

    public function editName(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        //UPDATE USER
        //GET the User
        $user = User::find(Auth::user()->id);

        //ASSIGN the new data to the user
        $user->name = trim($request->name);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Name updated');

    }

    public function editEmail(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        //UPDATE USER
        //GET the User
        $user = User::find(Auth::user()->id);

        //ASSIGN the new data to the user
        $user->email = trim($request->email);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Email updated');

    }

    public function editPassword(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        //UPDATE USER
        //GET the User
        $user = User::find(Auth::user()->id);

        //ASSIGN the new data to the user
        $user->password = Hash::make(trim($request->password));

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Password updated');

    }

    public function editPhoneNo(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'phoneNo' => ['string', 'min:11', 'max:12', 'nullable'],

        ]);

        //UPDATE USER
        //GET the User
        $user = User::find(Auth::user()->id);

        //ASSIGN the new data to the user
        $user->phoneNo = trim($request->phoneNo);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Phone No updated');

    }

    public function editProgrammeID(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'programmeID' => ['string', 'nullable'],
        ]);

        //UPDATE USER
        //GET the User
        $user = User::find(Auth::user()->id);

        //ASSIGN the new data to the user
        $user->programmeID = trim($request->programmeID);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Programme updated');

    }

    public function deleteAccount()
    {

        //REDIRECT ROUTE (To do the delete confirmation)
        return view('users.confirmDeleteAccount');
    }

    public function deletedAccount()
    {

        //DELETE USER
        //GET the User
        $user = User::find(Auth::user()->id);

        //DELETE the user
        $user->delete();

        //LOGOUT
        auth()->logout();

        //REDIRECT ROUTE
        return view('auth.login');
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
