<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Percentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PercentageController extends Controller
{
    public function update(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'bracket_string' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()], 422);
        }

        try {
            // Find the percentage entry
            $percentage = Percentage::findOrFail($id);

            // Update fields
            $percentage->user_id = $request->input('user_id');
            $percentage->bracket_string = $request->input('bracket_string');
            $percentage->percentage = $this->calculatePercentage($request->input('bracket_string'));
            $percentage->save();

            return response()->json([
                'percentage' => $percentage->percentage,
                'message' => 'Percentage updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    private function calculatePercentage($bracketString)
    {
        // Custom logic to calculate percentage
        // Example: Calculate the length of the bracket string as a percentage
        return strlen($bracketString); // Example calculation
    }
}

