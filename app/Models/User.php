<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
   
    public function subjects()
    {
        return $this->belongsToMany(GrievanceSubject::class, 'assign_subjects');
    }

    public function syncSubjects(array $subjectIds)
    {
        $this->subjects()->sync($subjectIds);
    }

    public function track(){
        return $this->morphMany(Tracking::class,'creatable');
    }

    public function getUserNameAttribute()
    {
        return $this->name;
    }
    public function assignGrievances(){
        return $this->hasManyThrough(RaiseGrievance::class,AssignSubject::class,'user_id','subject_id','id','grievance_subject_id');
    }

}
