<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'teknologi' => 'nullable|string',
            'image' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $project = Project::create($validate);

        return response()->json([
            'success' => true,
            'message' => 'Data project berhasil ditambahkan.',
            'data' => $project,
        ], 201);
    }
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $validate = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'teknologi' => 'nullable|string',
            'image' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $project->update($validate);

        return response()->json([
            'success' => true,
            'message' => 'Data project berhasil diperbarui.',
            'data' => $project,
        ]);
    }
}
