<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Http\Requests\RaceRequest;

class RaceController extends Controller
{
    use \App\Http\Controllers\APIControllerTrait;

    protected $model;

    protected $relationships = ['Contest'];

    public function __construct(Race $model)
    {
        $this->model = $model;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RaceRequest $request)
    {
        return Race::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function update(RaceRequest $request, Race $race)
    {
        $race->update($request->all());
        return $race; 
    }

}
