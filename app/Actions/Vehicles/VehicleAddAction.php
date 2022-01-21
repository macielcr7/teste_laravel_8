<?php
namespace App\Actions\Vehicles;

use App\Actions\BaseAction;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;

class VehicleAddAction extends BaseAction{
    
    protected $vehicleModel;
    
    public function __construct(Vehicle $vehicleModel) {
        $this->vehicleModel = $vehicleModel;
    }

    public function execute($request){
        try{
            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            $this->vehicleModel->create($data);

            return [
                'success' => true,
                'message' => __('default.success_save', ['title' => __('vehicle.title')]),
            ];
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