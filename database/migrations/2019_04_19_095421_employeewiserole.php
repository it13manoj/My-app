<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Employeewiserole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeewiserole', function (Blueprint $table) {
            $table->bigIncrements('erole_id');
            $table->bigInteger('emp_id');
            $table->integer('child_id');
            $table->smallInteger('erole_status')->default(1);
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
        Schema::dropIfExists('employeewiserole');
    }
}
