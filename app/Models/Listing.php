<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description', 'logo', 'user_id'];

    public function scopeFilter($query, array $filters) {
        if($filters['tag']) {
            $query->where('tags', 'like', '%'.$filters['tag'].'%');
        }

        if($filters['search']) {
            $query->where('title', 'like', '%'.$filters['search'].'%')
            ->orWhere('description', 'like', '%'.$filters['search'].'%')
            ->orWhere('tags', 'like', '%'.$filters['search'].'%');
        }
    }

    // Relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
