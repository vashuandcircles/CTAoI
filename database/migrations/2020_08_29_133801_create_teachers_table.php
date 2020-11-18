<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid');
            $table->string('level')->nullable();
            $table->string('altphone')->nullable();
            $table->string('description')->nullable();
            $table->string('specialization')->nullable();
            $table->string('city')->nullable();
            $table->string('gender')->nullable();
            $table->string('state')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
