<?php
// app/Http/Controllers/Admin/AdminSpecialistController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeekerResource;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = User::where('role_id', 2)->filter($request->all());
        $specialists = $query->paginate(10);
        return SeekerResource::collection($specialists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'accepted' => 'boolean',
        ]);

        $specialist = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role_id' => 2, // Assuming role_id 2 is for specialists
            'accepted' => $request->input('accepted', false),
        ]);

        return response()->json($specialist, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $specialist = User::findOrFail($id);
        return response()->json($specialist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
            'accepted' => 'boolean',
        ]);

        $specialist = User::findOrFail($id);

        if ($request->has('name')) {
            $specialist->name = $request->input('name');
        }
        if ($request->has('email')) {
            $specialist->email = $request->input('email');
        }
        if ($request->has('password')) {
            $specialist->password = bcrypt($request->input('password'));
        }
        if ($request->has('accepted')) {
            $specialist->accepted = $request->input('accepted');
        }

        $specialist->save();

        return response()->json($specialist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specialist = User::findOrFail($id);
        $specialist->delete();

        return response()->json(['message' => 'Specialist deleted successfully']);
    }
}