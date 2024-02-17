<?php

namespace App\Listeners;

use App\Events\DashboardNotiEvent;
use App\Models\AssignSubject;
use App\Models\DashboardNotification as ModelsDashboardNotification;
use App\Models\RaiseGrievance;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use App\Notifications\DashboardNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Models\Role;

class SendDashboardNoti
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
    public function handle(DashboardNotiEvent $event): void
    {
      
        $subject_id = $event->user->subject_id;
        $subjectUser = AssignSubject::where('grievance_subject_id',$subject_id)->get('user_id');
        $normalUser = User::find($subjectUser);
        Notification::send($normalUser, new DashboardNotification($event->user));
 
        $adminRole = Role::where('name','super_admin')->first();
        if ($adminRole) {
           $adminUsers = $adminRole->users;
           Notification::send($adminUsers, new DashboardNotification($event->user));
       }
    }
}
