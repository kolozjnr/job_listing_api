<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Models\User;

class Jobs extends Model
{
    use HasFactory, Uuid;

    protected $fillable = ['user_id','job_id','job_title','apply_email','company_name','application_type','tags','sector','application_deadline','apply_email','is_urgent','is_filled','company_logo','status'];

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
