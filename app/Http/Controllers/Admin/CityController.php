<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cities = City::filter($request->all())->paginate(10);
        return CityResource::collection($cities);
    }

    public function indexForGuest()
    {
        $city = City::all();
        return CityResource::collection($city);
    }

    public function indexForGuestByCountry($countryId)
    {
        $cities = City::where('country_id', $countryId)->get();
        return CityResource::collection($cities);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        $data = $request->validated();
        $country = City::create($data);
        return new CityResource($country);
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        $city->load('jobs');
        return new CityResource($city);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $data = $request->validated();
        if ($city->update($data)) {
            return new CityResource($city);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        if ($city->delete()) {
            return response()->json(['message' => 'Deleted successfully']);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
