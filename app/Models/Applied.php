<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Applied extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'resume'
    ];

    /**
     * uuid setup
     * 
     */
    public $incrementing = false;

    protected $keyType = 'uuid';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
