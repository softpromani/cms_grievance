<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\RaiseGrievance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrievanceController extends Controller
{
    public function newGrievance(){
        $userId = Auth()->user()->id;
        $subject = AssignSubject::where('user_id',$userId)->first();
        $subject_arr = isset($subject->subject_id) ? json_decode($subject->subject_id) : [];

        $grievances = RaiseGrievance::whereIn('subject_id',$subject_arr)->where('status','new_raise')->get();
        return view('admin.new_grievance',compact('grievances'));
    }
    public function takeAction(Request $request,$id){
        // Tracking::find($id);
    }
}
