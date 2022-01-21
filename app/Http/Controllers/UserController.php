<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Users\GetUsersAction;
use App\Actions\Users\UserAddAction;
use App\Actions\Users\UserUpdateAction;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    
    public function index(GetUsersAction $getUsers, Request $request)
    {
        if (request()->wantsJson()) {
            $users = $getUsers->execute($request, true, true);
            return response()->json($users);
        }
        
        return view('users.index');
    }

    public function create(Request $request){
        $data = new User;
        return view('users.create', compact('data'));
    }

    public function store(UserCreateRequest $request, UserAddAction $userAdd){
        $response = $userAdd->execute($request);
        return response()->json($response);
    }

    public function edit(Request $request, int $id){
        $data = User::find($id);
        return view('users.edit', compact('data'));
    }

    public function update(UserUpdateRequest $request, UserUpdateAction $userUpdate, int $id){
        $response = $userUpdate->execute($request, $id);
        return response()->json($response);
    }

    public function destroy(UserDeleteAction $userDelete, int $id){
        $response = $userDelete->execute($id);
        return response()->json($response);
    }
}
