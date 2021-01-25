<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserClass extends Model
{
    protected $guarded = [];
    public function students()
    {
        return $this->hasMany(User::class);
    }

    public function details(){
        return $this->hasOne(Classroom::class,'id', 'class_id');
    }
}
