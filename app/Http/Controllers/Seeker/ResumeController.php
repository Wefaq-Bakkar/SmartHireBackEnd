<?php
// app/Http/Controllers/ResumeController.php
// app/Http/Controllers/ResumeController.php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function index()
    {
        $resumes = Resume::all();
        return response()->json($resumes);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $userId = auth()->id();
        $existingResume = Resume::where('user_id', $userId)->first();

        if ($existingResume) {
            File::delete(public_path($existingResume->file_path));
            $existingResume->delete();
        }

        $file = $request->file('file');
        $filePath = 'resumes/' . $file->getClientOriginalName();
        $file->move(public_path('resumes'), $file->getClientOriginalName());

        $resume = Resume::create([
            'user_id' => $userId,
            'file_path' => $filePath,
        ]);

        return response()->json($resume, 201);
    }
    public function show($id)
    {
        $resume = Resume::findOrFail($id);
        return response()->json($resume);
    }

    public function update(Request $request, $id)
    {
        $resume = Resume::findOrFail($id);

        $data = $request->validate([
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            File::delete(public_path($resume->file_path));
            $file = $request->file('file');
            $filePath = 'resumes/' . $file->getClientOriginalName();
            $file->move(public_path('resumes'), $file->getClientOriginalName());
            $data['file_path'] = $filePath;
        }

        $resume->update($data);

        return response()->json($resume);
    }

    public function destroy($id)
    {
        $resume = Resume::findOrFail($id);
        File::delete(public_path($resume->file_path));
        $resume->delete();

        return response()->json(['message' => 'Resume deleted successfully']);
    }
}