<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class);
    }

    public function responses()
    {
        return $this->hasMany(UserResponse::class);
    }
}
