<?php
namespace App\Actions\Vehicles;

use App\Actions\BaseAction;
use App\Models\Vehicle;

class VehicleDeleteAction extends BaseAction{
    
    protected $vehicleModel;
    
    public function __construct(Vehicle $vehicleModel) {
        $this->vehicleModel = $vehicleModel;
    }

    public function execute($id){
        try{
            $vehicle = $this->vehicleModel->find($id);
            if($vehicle->isFromUserAuthenticated()){
                $vehicle->delete();

                return [
                    'success' => true,
                    'message' => __('default.removed_save', ['title' => __('vehicle.title')]),
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
                'message' => __('default.failed_remove', ['title' => __('vehicle.title')]),
                'error' => $e->getMessage(),
            ];
        }
    }
}