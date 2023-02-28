<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Repositories\Interfaces\ILoginRepository;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $loginRepo;
    private $userRepo;

    public function __construct(ILoginRepository $loginRepo,IUserRepository $userRepo) {
        $this->loginRepo = $loginRepo;
        $this->userRepo = $userRepo;
    }


    public function authenticateUser(UserLoginRequest $request)
    {
        //if user is authenticated successfully
        if($this->loginRepo->authenticateUser($request->only(['email', 'password'])))
        {
            //update user last login
            $this->loginRepo->updateLastLogin($request->email);

            //get user details
            $user = $this->userRepo->getUserByEmail($request->email);

            //get token
            $token = $this->loginRepo->getAuthToken($user);
            $data = [
                'status'=> 200,
                'message'=>'authenticated successfully',
                'token'=>$token
            ];

            return response()->json($data, 200);
        }
        //return incorrect creds msg
        $data = [
            'status'=> 200,
            'message'=>'authentication failed',
            'token'=>null
        ];

        return response()->json($data, 200);
    }
}
