<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Request\StorePercentageRequest;
use App\Http\Controllers\Request\UpdatePercentageRequest;
use App\Http\Resources\PercentageResource;
use App\Models\percentage;
use http\Client\Request;

class PercentageController extends Controller{
    public function index(){
        return PercentageResource::collection(Percentage::all());
    }

    public function show(Percentage $percentage){
        return PercentageResource::make($percentage);
    }

    public function store(StorePercentageRequest $request){

        $percentage= percentage::create($request->validated());

        return PercentageResource::make($percentage);
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',

        ];
    }

//    public function update(UpdatePercentageRequest $request, Percentage $percentage){
//
//        $percentage->update($request->validated());
//        return PercentageResource::make($percentage);
//
//    }

    public function update(percentage $request, $id)
    {
        try {
            $percentage = Percentage::findOrFail($id);
            $percentage->user_id = $request->input('user_id');
            $percentage->bracket_string = $request->input('bracket_string');
            $percentage->percentage = $this->calculatePercentage($percentage); // Example function
            $percentage->save();

            return response()->json([
                'percentage' => $percentage,
                'message' => 'Percentage updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    private function calculatePercentage($percentage)
    {
        // Custom logic to calculate percentage
        return 75; // Example percentage
    }

}
