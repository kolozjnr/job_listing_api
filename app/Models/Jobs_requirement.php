<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Jobs_requirement extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'job_id','role','experience','qualification','gender','career_level'
    ];

    /**
     * uuid setup
     * 
     */
    public $incrementing = false;

    protected $keyType = 'uuid';

    public function jobs(){
        return $this->belongsTo(Jobs::class);
    }

}
