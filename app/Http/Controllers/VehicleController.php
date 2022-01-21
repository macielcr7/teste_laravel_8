<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Vehicles\GetVehiclesAction;
use App\Actions\Vehicles\VehicleAddAction;
use App\Actions\Vehicles\VehicleUpdateAction;
use App\Http\Requests\Vehicle\VehicleCreateRequest;
use App\Http\Requests\Vehicle\VehicleUpdateRequest;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index(GetVehiclesAction $getVehicles, Request $request)
    {
        if (request()->wantsJson()) {
            $vehicles = $getVehicles->execute($request, true, true);
            return response()->json($vehicles);
        }
        
        return view('vehicles.index');
    }

    public function create(Request $request){
        $data = new Vehicle;
        return view('vehicles.create', compact('data'));
    }

    public function store(VehicleCreateRequest $request, VehicleAddAction $vehicleAdd){
        $response = $vehicleAdd->execute($request);
        return response()->json($response);
    }

    public function edit(Request $request, int $id){
        $data = Vehicle::find($id);
        return view('vehicles.edit', compact('data'));
    }

    public function update(VehicleUpdateRequest $request, VehicleUpdateAction $vehicleUpdate, int $id){
        $response = $vehicleUpdate->execute($request, $id);
        return response()->json($response);
    }

    public function destroy(VehicleDeleteAction $vehicleDelete, int $id){
        $response = $vehicleDelete->execute($id);
        return response()->json($response);
    }
}
