<?php
namespace App\Actions\Users;

use App\Actions\BaseAction;
use App\Models\User;

class UserDeleteAction extends BaseAction{
    
    protected $userModel;
    
    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function execute($id){
        try{
            if($id == \Auth()->user()->id){
                return [
                    'success' => false,
                    'message' => __('user.you_delete_self'),
                ];
                return $this->errorResponse('You can not delete yourself.');
            }

            $user = $this->userModel->find($id);
            if($user->vehicles()->count() > 0){
                return [
                    'success' => false,
                    'message' => __('user.failed_delete_exist_vehicles'),
                ];
            }
            else{
                $user->delete();
            }

            return [
                'success' => true,
                'message' => __('default.removed_save', ['title' => __('user.title')]),
            ];
        }
        catch(\Exception $e){
            return [
                'success' => false,
                'message' => __('default.failed_remove', ['title' => __('user.title')]),
                'error' => $e->getMessage(),
            ];
        }
    }
}