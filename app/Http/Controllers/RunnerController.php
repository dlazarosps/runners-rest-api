<?php

namespace App\Http\Controllers;

use App\Models\Runner;
// use Illuminate\Http\Request;
use App\Http\Requests\RunnerRequest as Request;
use App\Http\Resources\RunnerResource;
class RunnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RunnerResource::collection(Runner::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Runner::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Runner  $runner
     * @return \Illuminate\Http\Response
     */
    public function show(Runner $runner)
    {
        return new RunnerResource($runner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Runner  $runner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Runner $runner)
    {
        $runner->update($request->all());
        return $runner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Runner  $runner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Runner $runner)
    {
        $runner->delete();
        return $runner;
    }
}
