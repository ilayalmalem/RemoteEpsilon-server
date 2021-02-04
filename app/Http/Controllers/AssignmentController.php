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

    public function ofUser(User $user)
    {
        return $user->assignments;
    }

    public function create(Request $request)
    {
        $date = date("Y-m-d H:i", time());

        $data = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'classroom_id' => 'required|numeric',
            'until_date'  => "required|after:$date",
        ]);

        $data['user_id'] = auth()->user()->id;

        $assignment = new Assignment($data);
        $files = $request->file('files');
        $assignment->save();
        
        foreach ($files as $file) {
            $path = $file->store('assets');
            $assignment->assets()->create([
                'path' => $path,
                'name' => auth()->user()->id,
                'assignment_id' => $assignment->id
            ]);
        }
        
        return $assignment;
    }
}
