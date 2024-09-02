<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::all();

        return response()->json($shipment, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shipments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'origin' => 'required|string|max:100',
            'destination' => 'required|string|max:100',
            'status' => 'required|in:Pending,In Transit,Delivered',
            'cargo_details' => 'required|string',
            'weight' => 'required|numeric',
        ]);

        $shipment = Shipment::create($request->all());

        return response()->json($shipment, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        $shipment = Shipment::find($id);

        if ($shipment) {
            return response()->json($shipment, 200);
        } else {
            return response()->json(['error' => 'Shipment not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        return view('shipments.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shipment = Shipment::find($id);

        if (!$shipment) {
            return response()->json(['error' => 'Shipment not found'], 404);
        } else {

        }
        $request->validate([
            'origin' => 'required|string|max:100',
            'destination' => 'required|string|max:100',
            'status' => 'required|in:Pending,In Transit,Delivered',
            'cargo_details' => 'required|string',
            'weight' => 'required|numeric',
        ]);

        $shipment->update($request->all());

        return redirect()->route('shipments.index')->with('success', 'Shipment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        return redirect()->route('shipments.index')->with('success', 'Shipment deleted successfully');
    }
}