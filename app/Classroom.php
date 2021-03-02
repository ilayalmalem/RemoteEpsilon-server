<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $guarded = [];
    
    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function students(){
        return $this->belongsToMany(User::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
