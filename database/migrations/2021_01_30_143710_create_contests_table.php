<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            
            $table->time('started_at', 3);
            $table->time('ended_at', 3);
            
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
