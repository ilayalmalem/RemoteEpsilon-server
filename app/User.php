<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function classrooms(){
        return $this->belongsToMany(Classroom::class);
    }

    public function overdueAssignments()
    {
        $date = date("Y-m-d h:i:s");
        $assignments = $this->allAssignments()['data']->where('until_date', '<', $date)->values();

        return [
            'data' => $assignments,
            'count' => $assignments->count() 
        ];
    }

    public function allAssignments()
    {
        // Fetch all classrooms
        $classrooms = DB::select('select classroom_id from classroom_user where user_id = ?', [$this->id]);
        $all = collect();
        foreach ($classrooms as $classroom) {
            $all->push($classroom->classroom_id);
        }

        $assignments = Assignment::whereIn('classroom_id', $all)->with(['user','classroom'])->orderByDesc('until_date')->get();
        
        return [
            'data' => $assignments,
            'count' => $assignments->count()
        ];
    }


    public function responses()
    {
        return $this->hasMany(UserResponse::class, 'main_presenter');
    }
}
