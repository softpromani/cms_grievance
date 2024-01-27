<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailOtp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\EmailVerifyMail;
class FrontendController extends Controller
{
    //
    public function email_verify_otp(){
        return view('email_verify');
    }
    public function email_verify(Request $request){
        // return $request->all();
        $otpNumber = rand(100000, 999999);
        $data=  EmailOtp::updateOrCreate(['Email_id'=>$request->email],[
            'Email_id'=>$request->email,
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
      <button type="submit" class="btn btn-danger w-30 ml-5">Resend OTP</button>
      ';
      return response()->json(['data'=>$html]);
    }

    // Email OTP Verification

    public function otp_verify(Request $request){
        if(EmailOtp::where('Email_id',$request->email)->where('expiry_act','>',Carbon::now())->get()){
            $user_otp= EmailOtp::where('Email_id',$request->email)->get('otp');
             if($user_otp[0]->otp==$request->otp){
                
             }else{
                Session::flash('error','Wrong OTP');
                 return redirect()->back();
             }    
        } else{
            Session::flash('error','OTP Expired');
            return redirect()->back();
        }
        
    }
       
    public function grievance_user_register(){
      return view('grievance_user_register');
    }
    }

