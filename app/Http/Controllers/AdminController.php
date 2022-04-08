<?php
// Author:Lai Man Wai 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        
    }

    public function adminLogout(Request $request){
        if(Auth::guard('admin')->check()) // this means that the admin was logged in.
        {
            Auth::guard('admin')->logout();
            return redirect()->route('adminLogin');
        }
    
        $this->guard()->logout();
        $request->session()->invalidate();
    
        return $this->loggedOut($request) ?: redirect()->route('adminLogin');
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
        $user = User::find($id);

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
        return redirect()->route('usersDashboard')->with('delete','User Deleted');
    }

    //SUPPLIER
    public function supplierDashboard()
    {

        $suppliers = DB::table('suppliers')->select('*')->get();

        return view('admin.supplierDashboard')->with('suppliers',$suppliers);

    }

    public function addSupplier(){
        return view('admin.addSupplier');
    }

    public function addedSupplier(Request $request){
        
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phoneNo' => ['string', 'min:10','max:11','nullable'],
            'shopName'=> ['string','nullable'],
            'location'=> ['string','nullable'],
        ]);

        Supplier::create([
            'name' => trim($request->name),
            'email' =>trim($request->email),
            'password' => Hash::make(trim($request->password)),
            'phoneNo' => trim($request->phoneNo),
            'shopName'=> trim($request->shopName),
            'location'=> trim($request->location),
        ]);
        
        return redirect()->route('suppliersDashboard')->with('status','Added a new printing supplier');
    }

    public function editSupplier($id){
        $supplier = Supplier::find($id);

        return view('admin.editSupplier')->with('userID',$id)->with('user',$supplier);

    }

    public function editSupplierName(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        //UPDATE USER
        //GET the User 
        $user = Supplier::find($request->userID);

        //ASSIGN the new data to the user 
        $user->name = trim($request->name);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Name updated');

    }

    public function editSupplierEmail(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        //UPDATE USER
        //GET the User 
        $user = Supplier::find($request->userID);

        //ASSIGN the new data to the user 
        $user->email = trim($request->email);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Email updated');

    }

    public function editSupplierPassword(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);

        //UPDATE USER
        //GET the User 
        $user = Supplier::find($request->userID);

        //ASSIGN the new data to the user 
        $user->password = Hash::make(trim($request->password));

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Password updated');

    }

    public function editSupplierPhoneNo(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'phoneNo' => ['string', 'min:11', 'max:12', 'nullable'],
           
        ]);

        //UPDATE USER
        //GET the User 
        $user = Supplier::find($request->userID);

        //ASSIGN the new data to the user 
        $user->phoneNo = trim($request->phoneNo);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Phone No updated');

    }

    public function editSupplierShopName(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'shopName' => ['string', 'required'],
        ]);

        //UPDATE USER
        //GET the User 
        $user = Supplier::find($request->userID);

        //ASSIGN the new data to the user 
        $user->shopName = trim($request->shopName);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Shop Name updated');

    }

    public function editSupplierLocation(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'location' => ['string', 'required'],
        ]);

        //UPDATE USER
        //GET the User 
        $user = Supplier::find($request->userID);

        //ASSIGN the new data to the user 
        $user->location = trim($request->location);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Location updated');

    }

    public function deleteSupplier($id){

        //GET the User by id
        $user = Supplier::find($id);

        //DELETE the user
        $user->delete();

        //REDIRECT ROUTE (To do the delete confirmation page)
        return redirect()->route('suppliersDashboard')->with('delete','Supplier Deleted');
    }

    //Search ADMIN
    public function adminDashboard()
    {

        $admin = DB::table('admins')->select('*')->get();

        return view('admin.adminDashboard')->with('admins',$admin);

    }

    public function addAdmin(){
        return view('admin.addAdmin');
    }

    public function addedAdmin(Request $request){
        
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phoneNo' => ['string', 'min:10','max:11','nullable'],
        ]);

        Admin::create([
            'name' => trim($request->name),
            'email' =>trim($request->email),
            'password' => Hash::make(trim($request->password)),
            'phoneNo' => trim($request->phoneNo),
        ]);
        
        return redirect()->route('adminDashboard')->with('status','Added a new admin account');
    }

    public function editAdmin($id){
        $admin = Admin::find($id);

        return view('admin.editAdmin')->with('userID',$id)->with('user',$admin);

    }

    public function editAdminName(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        //UPDATE USER
        //GET the User 
        $user = Admin::find($request->userID);

        //ASSIGN the new data to the user 
        $user->name = trim($request->name);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Name updated');

    }

    public function editAdminEmail(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        //UPDATE USER
        //GET the User 
        $user = Admin::find($request->userID);

        //ASSIGN the new data to the user 
        $user->email = trim($request->email);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Email updated');

    }

    public function editAdminPassword(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);

        //UPDATE USER
        //GET the User 
        $user = Admin::find($request->userID);

        //ASSIGN the new data to the user 
        $user->password = Hash::make(trim($request->password));

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Password updated');

    }

    public function editAdminPhoneNo(Request $request)
    {
        //VALIDATE INPUT
        $this->validate($request, [
            'phoneNo' => ['string', 'min:11', 'max:12', 'nullable'],
           
        ]);

        //UPDATE USER
        //GET the User 
        $user = Admin::find($request->userID);

        //ASSIGN the new data to the user 
        $user->phoneNo = trim($request->phoneNo);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Phone No updated');

    }

    public function deleteAdmin($id){

        //GET the User by id
        $user = Admin::find($id);

        //DELETE the user
        $user->delete();

        //REDIRECT ROUTE (To do the delete confirmation page)
        return redirect()->route('adminDashboard')->with('delete','Admin Deleted');
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
