<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Shipment;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index() {
        return response()->json(Status::all(), 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|unique:statuses,name|max:100',
        ]);

        $status = Status::create($request->all());

        return response()->json($status, 200);
    }

    public function show($id) {
        $status = Status::find($id);

        if ($status) {
            return response()->json($status, 200);
        } else {
            return response()->json(['error' => 'Status not found'], 404);
        }
    }

    public function update(Request $request, $id) {
        $status = Status::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:statuses,name|max:100',
        ]);

        $status->update($request->all());

        return response()->json($status, 200);
    }

    public function destroy($id) {
        $status = Status::findOrFail($id);

        // Update all shipments with this status to 'Pending'
        Shipment::where('status', $status->name)->update(['status' => 'Pending']);
        $status->delete();

        return response()->json(['message' => 'Status deleted successfully'], 200);
    }
}