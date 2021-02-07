<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserResponse extends Model
{
    protected $guarded = [];
    protected $table = 'responses';

    public function presentor()
    {
        return $this->belongsTo(User::class, 'main_presenter');
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class);
    }

    public function assignment() 
    {
        return $this->belongsTo(Assignment::class);
    }
}
