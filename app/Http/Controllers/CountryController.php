<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = Country::all();
        return CountryResource::collection($country);
    }
    public function indexForGuest()
    {
        $country = Country::all();
        return CountryResource::collection($country);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        $data = $request->validated();
        $country = Country::create($data);
        return new CountryResource($country);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        $country->load('cities');
        return new CountryResource($country);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $data = $request->validated();
        if ($country->update($data)) {
            return new CountryResource($country);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        if ($country->delete()) {
            return response()->json(['message' => 'Deleted successfully']);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
