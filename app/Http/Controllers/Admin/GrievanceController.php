<?php

namespace App\Http\Controllers\Admin;

use App\Events\ActionEvent;
use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\GrievanceUser;
use App\Models\RaiseGrievance;
use App\Models\Tracking;
use App\Helpers\CustomHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrievanceController extends Controller
{
    public function newGrievance(){
        $userId = Auth()->user()->id;
        $grievances = [];
        $subject = AssignSubject::where('user_id',$userId)->get();
            $grievances = RaiseGrievance::whereIn('subject_id',$subject->pluck('grievance_subject_id'))->where('status','new_raise')->latest()->paginate(10);
        
        return view('admin.new_grievance',compact('grievances'));
    }
    public function takeAction(Request $request){
        
        $validate = $request->validate([
            'grievance_id'=>'required|exists:raise_grievances,id',
            'message'=>'required',
            'file'=>'nullable'
        ]);
       
        $data= Auth::user()->track()->create([
            'message'=>$request->message,
            'grievance_id'=>$request->grievance_id,
            'action'=>'action_taken',
          ]);
          if($request->file){
            $path='grievance';
            $file = $request->file;
            $media=uploadFile($data,$path,$file);
          }

        if($data){
            $grievance_id = RaiseGrievance::where('id',$data->grievance_id)->first();
            $grievance_id->update(['status'=>'open']);
            event(new ActionEvent($grievance_id));
        
       }
       if(isset($data)){
        return redirect()->route('admin.pengrievance')->with('success','Action Taken');
       }
       else{
        return redirect()->back()->with('error','error....!');
       }
    }
    public function pendingGrievance(Request $request)
    {
        $userId = Auth()->user()->id;
        $subject = AssignSubject::where('user_id',$userId)->get();
        $pengrievances = [];
        $subject = AssignSubject::where('user_id',$userId)->get();
        $pengrievances = RaiseGrievance::whereIn('subject_id',$subject->pluck('grievance_subject_id'))->where('status','open')->latest()->paginate(10);
    
       
       
        return view('admin.pending_grievance',compact('pengrievances'));
    }
    public function closeGrievance(Request $request)
    {
        $userId = Auth()->user()->id;
        $subject = AssignSubject::where('user_id',$userId)->first();
        $subject_arr = isset($subject->subject_id) ? json_decode($subject->subject_id) : [];

        $closegrievance = RaiseGrievance::whereIn('subject_id',$subject_arr)->where('status','close')->paginate(10);
        return view('admin.close_grievance',compact('closegrievance'));
    }

    public function markRead(Request $request){
        auth()->user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })->markAsRead();
    return response()->noContent();
    }

}
