<?php
// app/Http/Controllers/Admin/AdminOfferController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;

class AdminOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $offers = Offer::filter($request->all())->paginate(10);
        return OfferResource::collection($offers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        $data = $request->validated();

        $offer = Offer::create($data);

        return response()->json($offer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer = Offer::findOrFail($id);
        return response()->json($offer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, string $id)
    {
        $data = $request->validated();

        $offer = Offer::findOrFail($id);
        $offer->update($data);

        return response()->json($offer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        return response()->json(['message' => 'Offer deleted successfully']);
    }
}