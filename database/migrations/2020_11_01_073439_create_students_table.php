<?php
//
//use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;
//
//class CreateStudentsTable extends Migration
//{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        Schema::create('students', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->integer('user_id');
//            $table->foreign('user_id')->references('id')->on('users');
//            $table->string('level')->nullable();
//            $table->string('description')->nullable();
//            $table->string('city')->nullable();
//            $table->string('gender')->nullable();
//            $table->string('state')->nullable();
//            $table->string('imgpath')->nullable();
//            $table->boolean('active')->default(1);
//            $table->timestamps();
//        });
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        Schema::dropIfExists('students');
//    }
//}
