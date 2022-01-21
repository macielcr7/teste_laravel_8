<?php
namespace App\Actions\Users;

use App\Actions\BaseAction;
use App\Models\User;

class GetUsersAction extends BaseAction{
    
    protected $userModel;
    
    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function execute($request, $datatable=false, $paginate=false){
        if($datatable){
            $request = $this->prepareRequest($request, $paginate);
        }

        $query = $this->userModel->where(function($q) use ($request){
            $q->identic('id', $request->search)
                ->orLike('name', $request->search)
                ->orLike('email', $request->search);
        })
        ->orderBy($request->orderBy, $request->sortedBy);
        
        if($paginate){
            $data = $query->paginate($request->length);
            $response = [
                'data'=> $data->items(),
            ];
        }
        else{
            $data = $query->get();
            return [
                'data'=> $data,
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