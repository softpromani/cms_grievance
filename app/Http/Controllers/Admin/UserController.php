<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\GrievanceSubject;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
        $Roles = Role::all();
        $subjets = GrievanceSubject::all();
        return view('admin.all_users',compact('users','Roles','subjets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        dd($validate);
        $data = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ])->syncRoles($request->role);

        if($data){
            return redirect()->back()->with('success','User Register Successfully');
        }
        else{
            return redirect()->back()->with('error','User not Register ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = User::find(Crypt::decrypt($id));
        $users = User::paginate(20);
        $Roles = Role::all();
        $subjets = GrievanceSubject::all();
        return view('admin.all_users',compact('users','edit','Roles','subjets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate(['role'=>'required']);
        $users = User::find($id);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        $users->update($data);
        if($request->role){
            $role = User::find($id);
            // dd($role,$request->all());
            $role->syncRoles([$request->role]);
        }
        if($data){
            return redirect()->route('admin.user.store')->with('success','User Update Successfully');
        }
        else{
            return redirect()->back()->with('error','User not Update ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = User::find($id)->delete();
        if($delete){
            return back()->with('success', 'User Deleted successfully');
        }
        else {
            return back()->with('error', 'Oh! User did not Delete');
        }
    }
}
