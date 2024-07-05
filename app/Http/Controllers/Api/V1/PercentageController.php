<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Request\StorePercentageRequest;
use App\Http\Controllers\Request\UpdatePercentageRequest;
use App\Http\Resources\PercentageResource;
use App\Models\percentage;

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

    public function update(UpdatePercentageRequest $request, Percentage $percentage){

        $percentage->update($request->validated());
        return PercentageResource::make($percentage);

    }

    public  function destroy(Percentage $percentage){
        $percentage->delete();
        return response()->noContent();
    }

}
