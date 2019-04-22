<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
           $table->bigIncrements('company_id');
           $table->string('company_name');
           $table->bigInteger('company_category')->nullable();
           $table->bigInteger('company_city')->nullable();
           $table->bigInteger('company_state')->nullable();
           $table->bigInteger('company_country')->nullable();
           $table->text('company_address')->nullable();
            $table->longText('additionalinfo')->nullable();
           $table->string('company_email')->nullable();
           $table->string('company_contact')->nullable();
           $table->string('company_website')->nullable();
           $table->string('number_of_employees')->nullable();
           $table->longText('company_about')->nullable();
           $table->string('company_form_of_business')->nullable();
           $table->string('company_capital')->nullable();
           $table->string('company_sales')->nullable();
           $table->string('company_corporate_number')->nullable();
           $table->text('company_pics')->nullable();
           $table->string('company_establish_date')->nullable();
           $table->string('company_logo')->nullable();
           $table->string('company_cover_image')->nullable();
           $table->string('company_fb')->nullable();
           $table->string('company_twitter')->nullable();
           $table->string('company_google_plus')->nullable();
           $table->string('company_linked_in')->nullable();
           $table->string('company_lat')->nullable();
           $table->string('company_long')->nullable();
           $table->bigInteger('company_package')->nullable();
           $table->bigInteger('company_owner')->nullable();
           $table->text('company_videos')->nullable();
           $table->text('company_slug')->nullable();
           $table->tinyInteger('is_marked_top')->default(0);
           $table->tinyInteger('is_marked_featured')->default(0);

           $table->tinyInteger('company_status')->default(1);
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
        Schema::dropIfExists('companies');
    }
}
