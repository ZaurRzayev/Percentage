<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PercentageResource;
use App\Models\percentage;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CompletePercentageController extends Controller
{
    /**
     * Handle the incoming request.
     */
//    public function __invoke(Request $request, $percentage_id)
//    {
//        // Find the percentage record by ID
//        $percentage = Percentage::findOrFail($percentage_id);
//
//        // Parse the bracket string and update the percentage
//        $percentage->percentage = $this->calculateFilledPercentage($request->input('bracket_string'));
//        $percentage->save();
//
//        // Return the updated percentage resource
//        return new PercentageResource($percentage);
//    }


    public function __invoke(Request $request, $percentage_id)
    {
        // Find the percentage record by ID or create a new one if not found
        $percentage = Percentage::firstOrNew(['id' => $percentage_id]);

        // If the percentage is a new instance (not retrieved from database)
        if (!$percentage->exists) {
            // Initialize the 'name' field based on $percentage_id
            $percentage->name = 'id' . $percentage_id;
            // Optionally, initialize any other default values
            $percentage->percentage = 0; // Set default percentage if needed

            // Specify the ID explicitly
            $percentage->id = $percentage_id;

            // Save the new percentage record
            $percentage->save();
        }

        // Parse the bracket string and update the percentage
        $percentage->percentage = $this->calculateFilledPercentage($request->input('bracket_string'));
        $percentage->save();

        $client = new \GuzzleHttp\Client([
            'verify' => false,
        ]);
        $response = $client->put('https://api.adalo.com/v0/apps/0fb25ec4-853d-487d-a48e-bb871341619a/collections/t_66ad570ab2cf4e91b74569e7becda694/1' . $percentage_id, [
            'json' => ([
                'Percentage' => $percentage,
            ]),
            'headers' => [
                'Authorization' => 'Bearer 5ckiny17el2vymy81icxgnsbu'
            ]
        ]);

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
