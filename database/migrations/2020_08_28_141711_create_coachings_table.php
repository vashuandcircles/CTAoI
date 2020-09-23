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
            $table->string('name');
            $table->string('directorname');
            $table->string('level')->nullable();
            $table->string('phone');
            $table->string('altphone')->nullable();
            $table->string('description')->nullable();
            $table->string('specialization')->nullable();
            $table->string('email');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('landmark')->nullable();
            $table->string('imgpath');
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
