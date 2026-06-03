<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Http\Resources\TreatmentResource;

class TreatmentsController extends Controller
{
    public function index()
    {
        return response()->json(TreatmentResource::collection(Treatment::all()));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'name'        => 'required|string',
            'price'       => 'required|numeric',
            'version'     => 'required',
        ]);

        $treatment = Treatment::create($validated);

        return response()->json([
            'message'   => 'Treatment created.',
            'treatment' => new TreatmentResource($treatment),
        ], 201);
    }

    public function show(Treatment $treatment)
    {
        return response()->json(new TreatmentResource($treatment));
    }

    public function update(Request $request, Treatment $treatment)
    {
        $treatment->update($request->all());

        return response()->json(new TreatmentResource($treatment));
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return response()->json(null, 204);
    }
}