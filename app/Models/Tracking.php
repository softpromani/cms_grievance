<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function creatable(){
        return $this->morphTo();
    }
    public function raise(){
        return $this->belongsTo(RaiseGrievance::class,'id');
    }

    public function media(){
        return $this->morphMany(Media::class,'mediable');
    }
   
}
