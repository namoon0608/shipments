<?php

namespace App\Http\Controllers;

use App\Models\ShippingLine;
use Illuminate\Http\Request;

class ShippingLineController extends Controller
{
    public function index()
    {
        return response()->json(ShippingLine::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $shippingLine = ShippingLine::create($request->all());
        return response()->json($shippingLine, 201);
    }

    public function update(Request $request, $id)
    {
        $shippingLine = ShippingLine::find($id);

        if (!$shippingLine) {
            return response()->json(['error' => 'Shipping Line not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $shippingLine->update($request->all());
        return response()->json($shippingLine, 200);
    }

    public function destroy($id)
    {
        $shippingLine = ShippingLine::find($id);

        if (!$shippingLine) {
            return response()->json(['error' => 'Shipping Line not found'], 404);
        }

        $shippingLine->delete();
        return response()->json(['status' => true, 'message' => 'Shipping Line deleted successfully'], 204);
    }
}