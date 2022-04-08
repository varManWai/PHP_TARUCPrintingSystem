<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Supplier;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function supplierLogout(Request $request){
        if(Auth::guard('supplier')->check()) // this means that the admin was logged in.
        {
            Auth::guard('supplier')->logout();
            return redirect()->route('supplierLogin');
        }
    
        $this->guard()->logout();
        $request->session()->invalidate();
    
        return $this->loggedOut($request) ?: redirect()->route('supplierLogin');
    }

    public function orderStatusDashboard()
    {

        $orders = DB::table('order') ->join('users', 'users.id', '=', 'order.userID')->where('order.status', '!=', 'Completed')->select('order.*','users.name AS username')->get();

        return view('supplier.orderStatus')->with('orders',$orders);

    }


    public function addSupplier(){
        return view('admin.addSupplier');
    }


    public function editOrderStatus($id){
        
        $order = order::where('orderID',$id)->first();

        return view('supplier.editStatus')->with('userID',$id)->with('order',$order);
    } 

    

    public function editedOrderStatus(Request $request)
    {
        $this->validate($request, [
            'status' => ['required'],
        ]);

        //UPDATE USER
        //GET the User 
        $order = order::where('orderID',$request->orderID)->first();

        // dd($order);

        //ASSIGN the new data to the user 
        $order->status = $request->status;

        //STORE the new data into database
        $order->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Status updated');

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
        
        return view('admin.supplierDashboard')->with('status','Added a new printing supplier');
    }

    public function editSupplier($id){
        $user = Supplier::find($id);

        return view('admin.editUser')->with('userID',$id)->with('user',$user);

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
        $user->programmeID = trim($request->programmeID);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Programme updated');

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
        $user->programmeID = trim($request->programmeID);

        //STORE the new data into database
        $user->save();

        //REDIRECT ROUTE
        return back()->with('updated', 'Programme updated');

    }

    public function deleteSupplier($id){

        //GET the User by id
        $user = Supplier::find($id);

        //DELETE the user
        $user->delete();

        //REDIRECT ROUTE (To do the delete confirmation page)
        return redirect()->route('supplierDashboard')->with('delete','Supplier Deleted');
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
