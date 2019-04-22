<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParentMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_menu', function (Blueprint $table) {
            $table->bigIncrements('parent_id');
            $table->string('parent_name');
            $table->string('parent_link');
            $table->bigInteger('parent_rolid');
            $table->smallInteger('parent_status')->default(1);
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
        Schema::dropIfExists('parent_menu');
    }
}
