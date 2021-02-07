<?php

namespace App\Http\Controllers;

use App\Assignment;


class ResponseController extends Controller
{
    public function turnIn(Assignment $assignment)
    {
        // Create a new response object
        $user = auth()->user();
        $response = $user->responses()->create([
            'name' => $user->id.date("Y-m-d H:i", time()),
            'description' => 'loremIPSUm',
            'assignment_id' => $assignment->id
        ]);

        return $response;
    }
}
