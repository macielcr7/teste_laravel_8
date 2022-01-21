<?php
namespace App\Actions\Users;

use App\Actions\BaseAction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserUpdateAction extends BaseAction{
    
    protected $userModel;
    
    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function execute($request, $id){
        try{
            $data = $request->all();
            if(isset($data['password']) && !empty($data['password'])){
                $data['password'] = Hash::make($data['password']);
            }
            else{
                unset($data['password']);
            }
            
            $this->userModel->find($id)
                ->fill($data)
                ->save();

            return [
                'success' => true,
                'message' => __('default.success_save', ['title' => __('user.title')]),
            ];
        }
        catch(\Exception $e){
            return [
                'success' => false,
                'message' => __('default.failed_save', ['title' => __('user.title')]),
                'error' => $e->getMessage(),
            ];
        }
    }
}