<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndependentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create the units table 
        Schema::create('units', function (Blueprint $table){
            $table->increments('id');
            $table->string('name'); // this holds like the xter too
            $table->integer('points');
        });

        //create the levels table
        Schema::create('levels', function (Blueprint $table){
            $table->increments('id');
            $table->string('name'); // e.g 200L
            $table->string('nick_name')->nullable(); // e.g sophmore

        });

        //create the grades table
        Schema::create('grades', function (Blueprint $table){
            $table->increments('id');
            $table->string('grade'); // the xter e.g A
        });

        //create the acdemic_years table
        Schema::create('academic_years', function (Blueprint $table){
            $table->increments('id');
            $table->string('year')->unique(); // e.g 2018/19
            $table->string('name')->nullable(); // e.g graduating class name

        });

        //create the faculties table
        Schema::create('faculties', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            //add head of faculty later   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('units');
        Schema::drop('levels');
        Schema::drop('grades');
        Schame::drop('academic_years');
    }
}
