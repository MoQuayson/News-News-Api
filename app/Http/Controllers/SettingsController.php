<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IFeedsPreferenceRepository;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    private $userRepo;
    private $preferenceRepo;

    public function __construct(IUserRepository $userRepo,IFeedsPreferenceRepository $preferenceRepo) {
        $this->userRepo = $userRepo;
        $this->preferenceRepo = $preferenceRepo;
    }

    public function profileSettings($id)
    {
        //get user info
        $user = $this->userRepo->getUserById($id);
        //get preferences
        $preference = $this->preferenceRepo->getPreferences($id);
        $data=[
            'status'=>200,
            'message'=>'retrieved successfully',
            'user'=>$user,
            'preference'=>$preference
        ];

        return response()->json($data);
    }
}
