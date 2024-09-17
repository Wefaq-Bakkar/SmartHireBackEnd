<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePreferenceCategoryRequest;
use App\Http\Requests\UpdatePreferenceCategoryRequest;
use App\Models\PreferenceCategory;
use Illuminate\Http\Request;

class PreferenceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $preferenceCategories = PreferenceCategory::where('user_id', $user->id)->get();
        return response()->json($preferenceCategories);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePreferenceCategoryRequest $request)
    {
        $data = $request->validated();
        $preferenceCategory = PreferenceCategory::create($data);
        return response()->json($preferenceCategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $preferenceCategory = PreferenceCategory::findOrFail($id);
        return response()->json($preferenceCategory);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(UpdatePreferenceCategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $preferenceCategory = PreferenceCategory::findOrFail($id);
        $preferenceCategory->update($data);
        return response()->json($preferenceCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $preferenceCategory = PreferenceCategory::findOrFail($id);
        $preferenceCategory->delete();
        return response()->json(null, 204);
    }
}