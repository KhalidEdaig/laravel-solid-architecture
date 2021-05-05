<?php

namespace App\Http\User;

use App\Http\ResponseController;
use App\Http\User\Requests\CreateOrUpdateUserRequest;
use App\Http\User\Resources\Base\UserResource;
use App\Models\User;

class UserController extends ResponseController
{
  private $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->middleware('auth:api_user');
    $this->userRepository = $userRepository;
  }

 /*  public function store(CreateOrUpdateUserRequest $request)
  {
    $user = $this->userRepository->create($request->all());

    return response()->json(new UserResource($user));
      
  }

  public function update(CreateOrUpdateUserRequest $request,User $user)
  {
    $user = $this->userRepository->update($request->all(),$user->id);
    
    return response()->json(new UserResource($user));
      
  } */
}
