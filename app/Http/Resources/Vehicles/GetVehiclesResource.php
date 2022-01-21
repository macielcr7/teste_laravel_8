<?php

namespace App\Http\Resources\Vehicles;

use Illuminate\Http\Resources\Json\JsonResource;

class GetVehiclesResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'type' => __('vehicle.types.'.$this->type),
            'model' => $this->model,
            'color' => $this->color,
            'plate' => $this->plate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
