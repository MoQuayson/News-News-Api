<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Repositories\Interfaces\IRegisterRepository;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $registerRepo;
    private $userRepo;

    public function __construct(IRegisterRepository $registerRepo,IUserRepository $userRepo) {
        $this->registerRepo = $registerRepo;
        $this->userRepo = $userRepo;
    }

    public function createNewAccount(UserRegisterRequest $request)
    {
        //create user
        $user = $this->registerRepo->createUser($request);

        //get token
        $token = $this->registerRepo->getAuthToken($user);
        $data = [
            'status'=> 200,
            'message'=>'user created successfully',
            'token'=>$token
        ];

        return response()->json($data, 200);
    }
}
