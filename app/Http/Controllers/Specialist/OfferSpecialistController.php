<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferSpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return OfferResource::collection(Offer::where('specialist_id', $user->id)->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        try {
            $data = $request->validated();
            $offer = Offer::create($data);
            return new OfferResource($offer);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $offer = Offer::find($id);
        $user = $request->user();
        if ($user->id !== $offer->specialist_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return new OfferResource($offer);
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
    public function destroy($id)
    {
        try {
            $offer = Offer::find($id);
            $offer->delete();
            return response()->json(['message' => 'Offer deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}