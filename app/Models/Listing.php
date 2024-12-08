<?php

namespace App\Models;

use App\Models\ListingApplication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'company', 'logo', 'location', 'website', 'email', 'description', 'tags'];

    //this scope filters tags and searches, it does the magic for both make sure you have an input field named search
    public function scopeFilter($query, array $filters) {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    public function applications() {
        return $this->hasMany(ListingApplication::class);
    }
}
