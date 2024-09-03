<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Status;
use App\Models\ShipmentHistory;
use App\Models\ShippingLine;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

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

        return response()->json($shipments, 200);
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
            'status' => 'required|in:' . implode(',', Status::pluck('name')->toArray()),
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
    public function show($id)
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
        try {
            $shipment = Shipment::find($id);

            $request->validate([
                'origin' => 'required|string|max:100',
                'destination' => 'required|string|max:100',
                'status' => 'required|in:' . implode(',', Status::pluck('name')->toArray()),
                'cargo_details' => 'required|string',
                'weight' => 'required|numeric',
                'shipping_line_id' => 'nullable|exists:shipping_lines,shipping_line_id', // Validate shipping line
            ]);


            if (!$shipment) {
                return response()->json(['error' => 'Shipment not found'], 404);
            }

            $shipment->update($request->all());

            return response()->json($shipment, 200);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Return a generic error message for other exceptions
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipment = Shipment::findOrFail($id);
        $shipment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Delete Successfully'
        ], 200);
    }

    public function history($id)
    {
        $history = ShipmentHistory::where('shipment_id', $id)->get();

        if ($history->isEmpty()) {
            return response()->json(['message' => 'No history found for this shipment.'], 404);
        }

        return response()->json($history, 200);
    }
}