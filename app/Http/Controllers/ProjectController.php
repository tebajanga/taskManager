<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Response;
use Auth;

class ProjectController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required',
            'code' => 'required'
        ]);
        $data['user_id'] = $user->id;

        $project = Project::create($data);
        return Response::json($project);
    }
}
