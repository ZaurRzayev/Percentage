<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PercentageResource;
use App\Models\Percentage;
use Illuminate\Http\Request;

class CompletePercentageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $percentage_id)
    {
        // Find the percentage record by ID
        $percentage = Percentage::findOrFail($percentage_id);

        // Parse the bracket string and update the percentage
        $percentage->percentage = $this->calculateFilledPercentage($request->input('bracket_string'));
        $percentage->save();

        // Return the updated percentage resource
        return new PercentageResource($percentage);
    }

    /**
     * Calculate the percentage based on the filled brackets.
     */
    private function calculateFilledPercentage($bracketString)
    {
        $totalSlots = 0;
        $filledSlots = 0;

        $pattern = '/\{([^\}]*)\}/';
        preg_match_all($pattern, $bracketString, $matches);

        foreach ($matches[1] as $match) {
            $totalSlots++;
            if (trim($match) !== '') {
                $filledSlots++;
            }
        }

        // Calculate percentage of filled slots
        if ($totalSlots > 0) {
            $percentage = ($filledSlots / $totalSlots) * 100;
        } else {
            $percentage = 0; // Default percentage if no slots
        }

        return $percentage;
    }
}
