<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContestRequest;
use App\Http\Requests\ContestInsertRequest;

use App\Models\Contest;
use App\Models\Race;
use App\Models\Runner;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rank(Race $race)
    {   
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
    public function store(ContestInsertRequest $request)
    {
        // TODO less verbose (relations)
        $race_id = $request->all()['race_id'];
        $runner_id = $request->all()['runner_id'];

        $race = Race::find($race_id);
        $runner = Runner::find($runner_id);

        if (!$race || !$runner) {
            return response()->json('Race OR Runner not found', 404);
        }

        $others_race_date = Race::where('race_date', $race->race_date)->pluck('id');

        if ($others_race_date) {
            $others_runner_race_date = Contest::where('runner_id', $runner->id)
                ->whereIn('race_id', $others_race_date)
                ->count();

            if ($others_runner_race_date) {
                return response()->json('Runner already registered in Contest at this date', 406);
            }
        }

        $contest = new Contest();

        $contest->race_id = $race_id;
        $contest->runner_id = $runner_id;

        $contest->save();

        return $contest->toJson();
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
    public function update(ContestRequest $request, Contest $contest)
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
