<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
           $table->bigIncrements('subcategory_id');
           $table->string('subcategory_name');
           $table->bigInteger('category_id')->nullable();
           $table->tinyInteger('subcategory_status')->default(0);
           $table->enum('subcategory_for',['Blog','Job']);
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
        Schema::dropIfExists('subcategories');
    }
}
