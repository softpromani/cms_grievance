<?php

namespace App\Listeners;

use App\Events\DashboardNotiEvent;
use App\Models\AssignSubject;
use App\Models\DashboardNotification as ModelsDashboardNotification;
use App\Models\RaiseGrievance;
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
        $user = $event->user;
        // $subject = AssignSubject::where('user_id',$user->id)->get();
        // foreach ($subject->pluck('grievance_subject_id') as $value) {
        //     $grievances = RaiseGrievance::where('subject_id',$value)->get();
        // }
        // Notification::send($user, new DashboardNotification($grievances));

        $adminRole = Role::where('name','super_admin')->first();
        if ($adminRole) {
           $adminUsers = $adminRole->users;
           Notification::send($adminUsers, new DashboardNotification($event->user));
       }
    }
}
