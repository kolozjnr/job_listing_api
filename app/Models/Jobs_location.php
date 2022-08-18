<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Jobs_location extends Model
{
    use HasFactory, Uuid;



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
