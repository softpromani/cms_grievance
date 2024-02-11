<?php

namespace App\Http\Controllers;

use App\Events\DashboardNotiEvent;
use Illuminate\Http\Request;
use App\Models\EmailOtp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Mail\EmailVerifyMail;
use App\Models\GrievanceUser;
use App\Models\Tracking;
use App\Models\RaiseGrievance;
use App\Models\GrievanceSubject;
use App\Models\UserType;
use  App\Http\Requests\UserGrievanceRequest;
use  App\Http\Requests\RaiseGrievanceRequest;
class FrontendController extends Controller
{
    //
    public function email_verify_otp(){
        return view('email_verify');
    }
    public function email_verify(Request $request){
        
      //   $validate=$request->validate([
      //     'email' => 'required|email',
      // ]);
        $otpNumber = rand(100000, 999999);
        $data=  EmailOtp::updateOrCreate(['Email_id'=>$request->email],[
            'email_id'=>$request->email,
            'otp'=>$otpNumber,
            'expiry_act'=>Carbon::now()->addMinutes(10),
        ]);
       
        Mail::to($request->email)->send(new EmailVerifyMail($data));
        
        $html=' 
        <div class="mb-2">
        <label for="nameApiKey" class="form-label">Enter OTP</label>
        <input
          class="form-control"
          type="email"
          name="email"
          value="'.$request->email.'"
          placeholder="Enter OTP"
          id=""
          data-msg=""
          readonly
        />
      </div>
        <div class="mb-2">
        <label for="nameApiKey" class="form-label">Enter OTP</label>
        <input
          class="form-control"
          type="text"
          name="otp"
          placeholder="Enter OTP"
          id=""
          data-msg=""
          required
        />
      </div>
      <button type="submit" class="btn btn-primary w-30">OTP Verify</button>
      <a type="submit" href="javascript:void(0)"   data="'.$request->email.'" id="resend_otp"class="btn btn-danger w-30 ml-5">Resend OTP</a>
      ';
      return response()->json(['data'=>$html]);
    }

    // Email OTP Verification

    public function otp_verify(Request $request){
            $emailOtp = EmailOtp::where('email_id', $request->email)
            ->where('expiry_act', '>', now())
            ->first();
        if ($emailOtp) {
             if($emailOtp->otp==$request->otp){
              $grievance_user=GrievanceUser::where('email',$request->email)->first();
                if(isset($grievance_user)){
                  if($grievance_user->email == $request->email){
                    Auth::guard('grievance')->loginUsingId($grievance_user->id);
                    return redirect()->route('user.dashboard');
                  }
                }else{
                  return redirect()->route('user-login.grievanceuser');
                }   
             }else{
                Session::flash('error','Wrong OTP');
                 return redirect()->back();
             }    
        } else{
            return redirect()->back()->with('error','OTP Expired');
        }
        
    }
       
    public function grievance_user_register(){
      $user_type=UserType::get();
     return view('grievance_user_register',compact('user_type'));
    }
    public function submit_user_grievance(UserGrievanceRequest $request){
      $user_data=GrievanceUser::create([
        'user_type'=>$request->user_type,
        'unicode'=>$request->unicode,
        'first_name'=>$request->fname,
        'last_name'=>$request->lname,
        'gender'=>$request->gender,
        'email'=>$request->email,
        'mobile'=>$request->mobile,
        'password'=>Hash::make($request->password),
        'course'=>$request->course,
        'year_semester'=>$request->year_semester,
        'course_complete_date'=>$request->course_complete_date,
      ]);
      if($user_data){
        Session::flash('success','Registration Successfully');
        return redirect()->route('user.dashboard');
      }else{
        Session::flash('error','Registration Not Successfully');
        return redirect()->back();
      }
    }


    // User Dashboard

    public function dashboard(){
     
      return view('user.dashboard');
    }
     // Raise Grievance
     public function grievance_raise(){
      $grievance_subject=GrievanceSubject::get();
      return view('user.raise_grievance',compact('grievance_subject'));
    } 
    public function raise_grievance(RaiseGrievanceRequest $request){
     $count=RaiseGrievance::whereYear('created_at',Carbon::now()->format('Y'))->count()+1;
    $complain_number= Carbon::now()->format('Ym') .'0000'.$count;
   
    $raise_data=RaiseGrievance::create([
      'subject_id'=>$request->subject,
      'title'=>$request->title,
      'user_id'=> Auth::guard('grievance')->user()->id,
      'grievance_code'=>$complain_number,
      'status'=>'new_raise',
    ]);
    if($raise_data){
      event(new DashboardNotiEvent($raise_data));
    }
    $result= Auth::guard('grievance')->user()->track()->create([
      'message'=>$request->message,
      'grievance_id'=>$raise_data->id,
      'action'=>'raise_by_user',
    ]);
    if($request->hasFile('raise_file')){
      $path='grievance';
      $media=uploadFile($raise_data,$path,$request->raise_file);
      Auth::guard('grievance')->user()->track()->create([
      'message'=>$request->message,
      'from'=>'user',
      'grievance_id'=>$raise_data->id,
      'action'=>'file_uploaded',
    ]);
  }
    if(isset($result)){
      Session::flash('sucess','Grievance Raise Sucessfully');
      return redirect()->back();
    }else{
      Session::flash('error','Something Error');
      return redirect()->back()->with(['sucess'=>'Grievance Raise Sucessfully']);
    }
    
    }
   // Pending Grievance 

   public function pending_grievance(){
    $complane_data = RaiseGrievance::where('user_id', Auth::guard('grievance')->user()->id)
                                    ->where('status', '!=', 'close')
                                    ->get();
    return view('user.pending_grievance', compact('complane_data'));
}


   public function grievance_detail($id){
    $tracking_data=Tracking::where('grievance_id',Crypt::decrypt($id))->get();
    return view('user.tracking',compact('tracking_data'));
   }

   public function grievance_close(){
    $close_data=RaiseGrievance::where('status','close')->get();
    return view('user.close_grievance',compact('close_data'));
   }
}