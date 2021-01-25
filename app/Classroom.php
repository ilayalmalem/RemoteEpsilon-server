<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $guarded = [];
    
    // public function students() {
    //     return $this->hasMany(User::class);
    // }
    public function assignments() {
        return $this->hasMany(Assignment::class);
    }
    

    public function students(){
        return $this->belongsToMany(User::class);
    }
}