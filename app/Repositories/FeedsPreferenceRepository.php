<?php


namespace App\Repositories;

use App\Models\NewsPreference;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\IFeedsPreferenceRepository;

class FeedsPreferenceRepository implements IFeedsPreferenceRepository{

    //get preferences
    public function getPreferences($userId)
    {
        return NewsPreference::where('user_id', $userId)->first();
    }

    public function createOrUpdatePreference($request)
    {
        $data=[
            'source'=>$request->source,
            'category'=>$request->category,
        ];

        //return count(NewsPreference::where('user_id', $request->id)->get());
        if(!NewsPreference::where('user_id',$request->id)->exists())
        {
            NewsPreference::create([
                'user_id'=>$request->id,
                'name'=>'preference',
                'value'=>$data,

            ]);
        }
        else{
            NewsPreference::where('user_id',$request->id)->update([
                'user_id'=>$request->id,
                'name'=>'update preference',
                'value'=>$data,

            ]);
        }
    }
}
