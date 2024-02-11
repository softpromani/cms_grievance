<?php

namespace App\Listeners;

use App\Events\ActionEvent;
use App\Mail\ActionMail;
use App\Models\GrievanceUser;
use App\Models\RaiseGrievance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendActionEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ActionEvent $event): void
    {
        $user = $event->guser;
        $data = GrievanceUser::where('id',$user->user_id)->first();
            Mail::to($data->email)->send(new ActionMail($user));
       
}
}
