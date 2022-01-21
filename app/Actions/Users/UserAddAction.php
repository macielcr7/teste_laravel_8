<?php
namespace App\Actions\Users;

use App\Actions\BaseAction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAddAction extends BaseAction{
    
    protected $userModel;
    
    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function execute($request){
        try{
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $this->userModel->create($data);

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