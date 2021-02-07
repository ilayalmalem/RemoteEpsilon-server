<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $guarded = [];

    
    public function assignments() {
        return $this->belongsToMany(Assignment::class);
    }

    public function responses() {
        return $this->belongsToMany(UserResponse::class);
    }
}
