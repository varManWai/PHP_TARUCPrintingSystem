<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(){
        return view('admin.usersDashboard');
    }

    // public function store(Request $request){
    //    //validate input
        
    //     $this->validate($request, [
    //         'name' => 'required|max:30',
    //         'email' => 'required|email|max:30',
    //         'password' => 'required|confirmed'
    //     ]);
        
    //     //store user
    //     User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password) //hash the password
    //     ]);

    //     //sign in user


    //     //redirecting
    //     return redirect()->route('dashboard');

       
       
       
    // }
}
