<?php


namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\ILoginRepository;

class LoginRepository implements ILoginRepository{

    public function authenticateUser($user)
    {
        if(Auth::attempt($user))
        {
            return true;
        }
        return false;
    }

    public function updateLastLogin($email)
    {
        $user = User::where('email',$email)->update([
            'last_login'=>now()->toDateTimeString()
        ]);

        return $user;
    }

    public function getAuthToken(User $user)
    {
        return $user->createToken('news aggregator api')->plainTextToken;
    }
}
