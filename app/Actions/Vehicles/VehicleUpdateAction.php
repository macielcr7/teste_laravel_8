<?php
namespace App\Actions\Vehicles;

use App\Actions\BaseAction;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;

class VehicleUpdateAction extends BaseAction{
    
    protected $vehicleModel;
    
    public function __construct(Vehicle $vehicleModel) {
        $this->vehicleModel = $vehicleModel;
    }

    public function execute($request, $id){
        try{
            $data = $request->all();
            $vehicle = $this->vehicleModel->find($id);

            if($vehicle->isFromUserAuthenticated()){
                $vehicle->fill($data)->save();

                return [
                    'success' => true,
                    'message' => __('default.success_save', ['title' => __('vehicle.title')]),
                ];
            }
            else{
                return [
                    'success' => false,
                    'message' => __('default.vehicle_not_your_modify'),
                ];
            }
        }
        catch(\Exception $e){
            return [
                'success' => false,
                'message' => __('default.failed_save', ['title' => __('vehicle.title')]),
                'error' => $e->getMessage(),
            ];
        }
    }
}