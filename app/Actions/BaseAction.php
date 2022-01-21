<?php
namespace App\Actions;

class BaseAction {

    public function prepareRequest($request, $paginate=false){
        if($paginate){
            $perPage = $request->length;
            if(isset($request->start)){
                $total = $request->start/$perPage;
                $page = ($total+1) > 0 ? $total + 1 : 1;
            }
            else{
                $page = 1;
            }
            
            $request->merge([
                'page' => $page,
                'search' => $request->search['value'],
                'orderBy' => $request->columns[ $request->order[0]['column'] ]['data'],
                'sortedBy' => $request->order[0]['dir']
            ]);
        }
        else{
            $request->merge([
                'search' => $request->search['value'],
                'orderBy' => $request->columns[ $request->order[0]['column'] ]['data'],
                'sortedBy' => $request->order[0]['dir']
            ]);
        }

        return $request;
    }
}