<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('adv_title');
            $table->text('adv_link');
            $table->string('advStartDate');
            $table->string('advEndDate');
            $table->smallInteger('adv_status')->default(0);
            $table->string('adv_image')->nullable();
            $table->string('adv_for')->nullable();
            $table->string('adv_category')->nullable();
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
        Schema::dropIfExists('advertisements');
    }
}
