<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChildMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_menu', function (Blueprint $table) {
            $table->bigIncrements('child_id');
            $table->string('child_menu_name');
            $table->string('child_menu_link');
            $table->bigInteger('child_parent_menu_id');
            $table->smallInteger('child_status')->default(1);
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
        Schema::dropIfExists('child_menu');
    }
}
