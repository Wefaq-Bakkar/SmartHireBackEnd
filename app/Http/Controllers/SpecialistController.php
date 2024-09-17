<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeekerResource;
use App\Models\User;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role_id', 2)->filter($request->all());
        $specialists = $query->paginate(10);
        return SeekerResource::collection($specialists);
    }
}
