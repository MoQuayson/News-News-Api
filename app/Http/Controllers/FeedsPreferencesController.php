<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsPreferenceRequest;
use App\Repositories\Interfaces\IFeedsPreferenceRepository;
use Illuminate\Http\Request;

class FeedsPreferencesController extends Controller
{
    private $newsPrefRepo;

    public function __construct(IFeedsPreferenceRepository $newsPrefRepo) {
        $this->newsPrefRepo = $newsPrefRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsPreferenceRequest $request)
    {
        //return $request->all();
        //check if preference exist
        $this->newsPrefRepo->createOrUpdatePreference($request);
        $preference = $this->newsPrefRepo->getPreferences($request->id);
        $data=[
            'status'=>200,
            'message'=>'updated successfully',
            'preference'=>$preference,

        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
