<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionName;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = PermissionName::paginate(20);
        return view('admin.permission',compact('permissions'));
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
        $request->validate([
            'permission' => 'required',
        ]);
        $perm = PermissionName::create(['name'=>str_replace(' ', '_', strtolower($request->permission))]);
       
        if(isset($perm))
        {
            $permission = Permission::create(['name' => $request->permission, 'perm_id' => $perm->id]);
            Permission::create( ['name' => $request->permission.'_create', 'perm_id' => $perm->id]);
            Permission::create( ['name' => $request->permission.'_read', 'perm_id' => $perm->id]);
            Permission::create( ['name' => $request->permission.'_edit', 'perm_id' => $perm->id]);
            Permission::create( ['name' => $request->permission.'_delete', 'perm_id' => $perm->id]);
            return isset($permission) ? redirect()->back()->with('success','Permission has been created successfully.') : redirect()->back()->with('error','Permission is not created');
        }
        else {
            return redirect()->back()->with('error','Something went wrong !');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
    public function rolePermission()
    {
        $roles=Role::all();
        return view('admin.rolehaspermission',compact('roles'));
    }

    public function fetchPermission(Request $request)
    {
        $selectrole=Role::find($request->role);
        $roles=Role::all();
        $permissionnames=PermissionName::all();
        return view('admin.rolehaspermission',compact('roles','permissionnames','selectrole'));
    }

    public function assignPermission(Request $request)
    {
        $request->validate([
            'roleid'=>'required',
            'rolepermissions'=>'required'
        ]);

        $role=Role::find($request->roleid);
        $role->syncPermissions($request->rolepermissions);
        return redirect()->route('admin.rolePermission')->with('success','Permission Assigned Successfully');
    }
}




