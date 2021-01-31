<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContestRequest as Request;

use App\Models\Contest;
use App\Models\Race;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contest::paginate(20);
    }

    public function rank(Race $race)
    {
        // return Contest::paginate(20);
        
        return Contest::orderBy('duration', 'asc')
            ->where([
                ['race_id', '=', $race->id],
            ])
            ->paginate(3); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Contest::create($request->paginate(20));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        return $contest;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        $contest->update($request->all());
        return $contest;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        $contest->delete();
        return $contest;
    }
}
