<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {

        $users = DB::table('users')->join('programme', 'users.programmeID','=','programme.programmeID') ->select('users.*', 'programme.name AS programmeName')->get();
        // $programmeID = DB::table('users')
        // ->select('programmeID')
        // ->where('id','=',$id)
        // ->get();
        // $programmeID = json_decode( json_encode($programmeID), true);
        // $programmeID = $programmeID[0]['programmeID'];

        // dd($programmes);
        

        return view('admin.usersDashboard')->with('users',$users);

    }

    public function editUser($id){
        $user = User::find(1);

        return view('admin.editUser')->with('userID',$id)->with('user',$user);

    }

    public function editUserName(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        //UPDATE USER
        //GET the User 
        $user = User::find($request->userID);

        //ASSIGN the new data to the user 
        $user->name = trim($request->name);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Name updated');

    }

    public function editUserEmail(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        //UPDATE USER
        //GET the User 
        $user = User::find($request->userID);

        //ASSIGN the new data to the user 
        $user->email = trim($request->email);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Email updated');

    }

    public function editUserPassword(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);

        //UPDATE USER
        //GET the User 
        $user = User::find($request->userID);

        //ASSIGN the new data to the user 
        $user->password = Hash::make(trim($request->password));

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Password updated');

    }

    public function editUserPhoneNo(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'phoneNo' => ['string', 'min:11', 'max:12', 'nullable'],
           
        ]);

        //UPDATE USER
        //GET the User 
        $user = User::find($request->userID);

        //ASSIGN the new data to the user 
        $user->phoneNo = trim($request->phoneNo);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Phone No updated');

    }

    public function editUserProgrammeID(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'programmeID' => ['string', 'nullable'],
        ]);

        //UPDATE USER
        //GET the User 
        $user = User::find($request->userID);

        //ASSIGN the new data to the user 
        $user->programmeID = trim($request->programmeID);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Programme updated');

    }

    public function deleteUser($id){

        //GET the User by id
        $user = User::find($id);

        //DELETE the user
        $user->delete();

        //REDIRECT ROUTE (To do the delete confirmation page)
        return redirect()->route('usersDashboard');
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
