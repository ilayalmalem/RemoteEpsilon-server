<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Classroom;
use App\User;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $data = auth()->user()->classrooms[0]->assignments;

        foreach($data as $assignment) {
            $assignment->owner = User::where('id', $assignment['user_id'])->first();
            $assignment->classroom = Classroom::where('id', $assignment['classroom_id'])->first();
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $assignment = Assignment::where('id', $id)->with('user')->first();
        $isAuthorized = false;

        foreach(auth()->user()->classrooms as $classroom) {
            if( $classroom->id == $assignment->classroom_id ) {
                $isAuthorized = true;
            }
        }

        if(!$isAuthorized) { 
            return abort(401);
        }

        return $assignment;
    }

    public function all()
    {
        return auth()->user()->allAssignments();
    }

    public function overdue()
    {
        return auth()->user()->overdueAssignments();
    }
}
