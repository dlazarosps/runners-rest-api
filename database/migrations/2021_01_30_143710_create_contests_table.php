<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->id();

            $start = Carbon::now();
            $end = Carbon::now()->add(47, 'minutes');

            $table->foreignId('race_id')->constrained('races');
            $table->foreignId('runner_id')->constrained('runners');
            
            $table->time('started_at', 3)->default($start->format('H:i:s'));
            $table->time('ended_at', 3)->default($end->format('H:i:s'));

            $table->time('duration', 3)->default($start->diff($end)->format('%H:%I:%S'));
            
            $table->timestamps();

            $table->unique(['race_id', 'runner_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contests');
    }
}
