<?php
namespace App\Actions\Vehicles;

use App\Http\Resources\Vehicles\GetVehiclesResource;
use App\Actions\BaseAction;
use App\Models\Vehicle;

class GetVehiclesAction extends BaseAction{
    
    protected $vehicleModel;
    
    public function __construct(Vehicle $vehicleModel) {
        $this->vehicleModel = $vehicleModel;
    }

    public function execute($request, $datatable=false, $paginate=false){
        if($datatable){
            $request = $this->prepareRequest($request, $paginate);
        }
        
        $query = $this->vehicleModel->where(function($q) use ($request){
            $q->identic('id', $request->search)
                ->orLike('plate', $request->search)
                ->orLike('color', $request->search)
                ->orLike('model', $request->search);
            })
            ->identic('user_id', $request->user_id)
            ->orderBy($request->orderBy, $request->sortedBy);
        
        if($paginate){
            $data = $query->paginate($request->length);
            $response = [
                'data'=> GetVehiclesResource::collection($data->items()),
            ];
        }
        else{
            $data = $query->get();
            return [
                'data'=> GetVehiclesResource::collection($data),
            ];
        }

        if($datatable){
            $response = array_merge($response, [
                'draw'              => $request->draw,
                'recordsTotal'      => $paginate ? $data->total() : count($data),
                'recordsFiltered'   => $paginate ? $data->total() : count($data),
            ]);
        }

        return $response;
    }
}