<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PercentageResource;
use App\Models\percentage;
use Illuminate\Http\Request;

class CompletePercentageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, percentage  $percentage)
    {
        $percentage->percentage = $request->percentage;
        $percentage->save();



        return PercentageResource::make($percentage);
    }
}
