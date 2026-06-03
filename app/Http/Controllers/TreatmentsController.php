<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Http\Resources\TreatmentResource;

class TreatmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $treatments = Treatment::all();

        return response()->json(TreatmentResource::collection($treatments));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Typically, this would render a view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'version' => 'required|int',
            'customer_id' => 'required|exists:customers,id',
        ]);

        $treatment = Treatment::create($validatedData);

        return response()->json([
            'message' => 'Treatment created.',
            'treatment' => $treatment,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment): \Illuminate\Http\JsonResponse
    {
        return response()->json(new TreatmentResource($treatment));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        // Typically, this would render a view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Treatment $treatment): \Illuminate\Http\JsonResponse
    {
        $treatment->update($request->all());

        return response()->json([
            'message' => 'Treatment updated.',
            'treatment' => $treatment,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment): \Illuminate\Http\JsonResponse
    {
        $treatment->delete();

        return response()->json([
            'message' => 'Treatment deleted.',
        ], 204);
    }
}