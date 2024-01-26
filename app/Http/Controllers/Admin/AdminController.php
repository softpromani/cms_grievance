<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function AdminLogin(Request $request){
        $validate = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        // dd($request->all());
        $login = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if($login){
        return redirect(route('admin.dashboard'))->with('success','Login successfully.');
        }
        else{
        return redirect()->back()->with('error','Error...');
        }
            
    }
    public function dashboard(){
        return view('welcome');
    }

    public function Register(Request $request){
        $validate = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        $data = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ])->syncRoles($request->role);
        if($data){
            return redirect('/')->with('success','Register Successfully');
        }
        else{
            return redirect()->back()->with('error','Error');
        }
    } 
    public function getRegister(){
        $Roles = Role::all();
        return view('admin.registration',compact('Roles'));
    }

    public function Logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
