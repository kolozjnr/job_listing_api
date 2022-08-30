<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Jobs_pay extends Model
{
    use HasFactory, Uudi;

    protected $fillable =[
        'job_id','max_salary','min_salary','currency','salary_type'
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
