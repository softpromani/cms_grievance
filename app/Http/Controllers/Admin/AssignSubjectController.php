<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'user_id'=>'required',
            'subject_id'=>'required'
        ]);  
        $all_sub = AssignSubject::updateOrCreate( [
            'user_id'=>$request->user_id,
        ]
            ,[
            'user_id'=>$request->user_id,
            'subject_id'=>json_encode($request->subject_id)
        ]);
        if($all_sub){
            return redirect()->route('admin.user.store')->with('success','Subject Assign Successfully');
        }
        else{
            return redirect()->back()->with('error',' Ops...! Subject Not Assign ');
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

    
}
