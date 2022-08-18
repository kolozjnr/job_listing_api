<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\User;

class Jobs extends Model
{
    use HasFactory, Uuid;



     /**
     * uuid setup
     * 
     */
    public $incrementing = false;

    protected $keyType = 'uuid';

    public function users(){
        return $this->belongsTo(User::class);
    }

    //relation between job pay table
    public function job_pay(){
        return $this->hasOne(Jobs_pay::class);
    }

    //relation between job Requirement table
    public function job_req(){
        return $this->hasOne(Jobs_requirement::class);
    }

     //relation between job Location table
     public function job_loc(){
        return $this->hasOne(Jobs_location::class);
    }
}
