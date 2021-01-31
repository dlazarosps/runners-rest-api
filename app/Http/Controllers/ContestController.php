<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContestInsertRequest;
use App\Http\Requests\ContestUpdateRequest;

use App\Models\Contest;
use App\Models\Race;
use App\Models\Runner;

use Carbon\Carbon;
class ContestController extends Controller
{
    use \App\Http\Controllers\APIControllerTrait;

    protected $model;

    protected $relationships = ['Race', 'Runner'];

    public function __construct(Contest $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rank(Race $race)
    {   
        return Contest::orderBy('duration', 'asc')
            ->with($this->relationships())
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

        $others_race_date = Race::where('race_date', $race->race_date)->pluck('id');

        if ($others_race_date) {
            $others_runner_race_date = Contest::where('runner_id', $runner->id)
                ->whereIn('race_id', $others_race_date)
                ->count();

            if ($others_runner_race_date) {
                return response()->json([
                    "message" => "The given data was invalid.", 
                    "errors" => [
                        406 => "Runner already registered in Contest at this date",
                    ] 
                ], 406);
            }
        }

        $contest = new Contest();

        $contest->race_id = $race_id;
        $contest->runner_id = $runner_id;

        $contest->save();

        return $contest;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(ContestUpdateRequest $request, Contest $contest)
    {
        $contest->update($request->all());
        return $contest;
    }

    /**
     * Update (results) the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function finish(ContestUpdateRequest $request)
    {
        $race_id = $request->all()['race_id'];
        $runner_id = $request->all()['runner_id'];

        $contest = Contest::where([
            ['race_id', '=', $race_id],
            ['runner_id', '=', $runner_id],
        ]);

        if (!$contest->count()) {
            return response()->json([
                "message" => "The given data was invalid.", 
                "errors" => [
                    404 => "Contest not found",
                ] 
            ], 404);
        }

        $contest_id = $contest->get('id');

        $started_at = $request->all()['started_at'];
        $ended_at = $request->all()['ended_at'];

        $start = Carbon::parse($started_at);
        $end = Carbon::parse($ended_at);

        $duration = $start->diff($end)->format('%H:%I:%S');

        $contest->update([
            'started_at' => $started_at,
            'ended_at' => $ended_at,
            'duration' => $duration,
        ]);

        return Contest::find($contest_id);
    }
}
