<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coachings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid');
            $table->string('directorname')->nullable();
            $table->string('level')->nullable();
            $table->string('altphone')->nullable();
            $table->string('description')->nullable();
            $table->string('eligibility')->nullable();
            $table->string('specialization')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('landmark')->nullable();
            $table->string('imgpath')->nullable();
            $table->boolean('verified')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coachings');
    }
}
