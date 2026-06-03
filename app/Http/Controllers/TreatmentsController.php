<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Models\Customer; // Add this import

class TreatmentsController extends Controller
{
    public function index()
    {
        $treatments = Treatment::all();
        return view('treatments.index', compact('treatments'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('treatments.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'version' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
        ]);

        Treatment::create($validatedData);

        return redirect()->route('treatments.index')->with('success', 'Treatment created successfully.');
    }

    public function show(Treatment $treatment)
    {
        return view('treatments.show', compact('treatment'));
    }

    public function edit(Treatment $treatment)
    {
        $customers = Customer::all();
        return view('treatments.edit', compact('treatment', 'customers'));
    }

    public function update(Request $request, Treatment $treatment)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'version' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
        ]);

        $treatment->update($validatedData);

        return redirect()->route('treatments.index')->with('success', 'Treatment updated successfully.');
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return redirect()->route('treatments.index')->with('success', 'Treatment deleted successfully.');
    }
}