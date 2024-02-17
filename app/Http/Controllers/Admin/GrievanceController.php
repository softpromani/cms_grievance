<?php

namespace App\Http\Controllers\Admin;

use App\Events\ActionEvent;
use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\GrievanceUser;
use App\Models\RaiseGrievance;
use App\Models\Tracking;
use App\Helpers\CustomHelper;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GrievanceController extends Controller
{
    public function newGrievance(){
        $grievances = Auth()->user()->assignGrievances()->where('status','new_raise')->latest()->paginate(10);
        return view('admin.new_grievance',compact('grievances'));
    }
    public function takeAction(Request $request){
        
        $validate = $request->validate([
            'grievance_id'=>'required|exists:raise_grievances,id',
            'message'=>'required|min:1',
            'file'=>'nullable'
        ]);
       if($validate==false){
        return redirect()->back()->with('error','Validation Error....');
       }
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
    //     $userId = Auth()->user()->id;
    //     $subject = AssignSubject::where('user_id',$userId)->get();
    //     $pengrievances = [];
    //     $pengrievances = RaiseGrievance::whereIn('subject_id',$subject->pluck('grievance_subject_id'))->where('status','open')->latest()->paginate(10);
        $pengrievances = Auth()->user()->assignGrievances()->where('status','open')->latest()->paginate(10);
        return view('admin.pending_grievance',compact('pengrievances'));
    }
    public function closeGrievance(Request $request)
    {
        $closegrievance = Auth()->user()->assignGrievances()->where('status','close')->latest()->paginate(10);
        return view('admin.close_grievance',compact('closegrievance'));
    }

    public function markRead(Request $request){
        auth()->user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })->markAsRead();
    return response()->noContent();
    }

    public function viewGrievance($id){
        $grievance=RaiseGrievance::find(Crypt::decrypt($id));    
        $tracking=$grievance->grievances;
        $user=$grievance->applicant;
        
        return view('admin.view_grievance',compact('user','tracking','grievance'));
    }

    public function grievanceQuery(Request $request){
        $validate = $request->validate([
            'message'=>'required',
            'grievance_id'=>'required',
            'file'=>'nullable'
        ]);
        $data= Auth::user()->track()->create([
            'message'=>$request->message,
            'grievance_id'=>$request->grievance_id,
            'action'=>'query',
          ]);
          if($request->file){
            $path='grievance';
            $file = $request->file;
            $media=uploadFile($data,$path,$file);
          }
          if($data){
            return redirect()->back()->with('success','Reply Successfully..');
          }
          else{
            return redirect()->back()->with('error','Ops... Reply Not Send');
          }
    }

}
