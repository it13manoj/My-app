<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('package_name');
            $table->longText('package_description')->nullable();
            $table->integer('package_price');
            $table->integer('package_duration');
            $table->integer('package_total_jobs');
            $table->integer('package_total_resume_download');
            $table->integer('package_total_excel_export');
            $table->integer('package_total_resume_views');
            $table->integer('package_total_resume_forward');
            $table->integer('package_total_resume_search');
            $table->integer('package_total_email');
            $table->integer('package_total_sms');
            $table->tinyInteger('package_status')->default(1);
            $table->tinyInteger('package_recruitment_service')->default(0);
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
        Schema::dropIfExists('packages');
    }
}
