<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function indexR(){
        $roles = Role::paginate(10);
        return view('admin.role',compact('roles'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
        ]);
        Role::create([
            'name' => $request->role,
            'guard_name'=>'web',
        ]);
        return redirect()->back()->with('success','Role has been created successfully.');
    }
   
}
