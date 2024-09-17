<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeekerResource;
use App\Models\User;
use Illuminate\Http\Request;


class AdminSeekerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('role_id', 3)->filter($request->all());
        $seekers = $query->paginate(10);
        return SeekerResource::collection($seekers);
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
        $seeker = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role_id' => 3, // Assuming role_id 3 is for seekers
            'accepted' => $request->input('accepted', false),
        ]);

        return response()->json($seeker, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seeker = User::findOrFail($id);
        return response()->json($seeker);
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

        $seeker = User::findOrFail($id);

        if ($request->has('name')) {
            $seeker->name = $request->input('name');
        }
        if ($request->has('email')) {
            $seeker->email = $request->input('email');
        }
        if ($request->has('password')) {
            $seeker->password = bcrypt($request->input('password'));
        }
        if ($request->has('accepted')) {
            $seeker->accepted = $request->input('accepted');
        }

        $seeker->save();

        return response()->json($seeker);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seeker = User::findOrFail($id);
        $seeker->delete();
        return response()->json(['message' => 'Seeker deleted successfully']);
    }
}