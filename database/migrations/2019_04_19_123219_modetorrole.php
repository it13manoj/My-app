<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Modetorrole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modetorrole', function (Blueprint $table) {
            $table->bigIncrements('m_id');
            $table->bigInteger('m_parent_id');
            $table->integer('modetor_id');
            $table->smallInteger('modetor_status')->default(1);
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
        Schema::dropIfExists('modetorrole');
    }
}
 