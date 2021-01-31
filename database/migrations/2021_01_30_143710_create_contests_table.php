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
            
            $table->foreignId('race_id')->constrained('races');
            $table->foreignId('runner_id')->constrained('runners');
            
            $table->timestamp('started_at')->default(Carbon::now()->format('Y-m-d H:i:s'));
            $table->timestamp('ended_at')->default(Carbon::now()->format('Y-m-d H:i:s'));

            $table->time('duration', 3)->nullable();
            
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
