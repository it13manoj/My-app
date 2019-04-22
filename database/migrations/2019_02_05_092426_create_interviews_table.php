<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->bigIncrements('interview_id');
            $table->bigInteger('job_id');
            $table->bigInteger('venue_id');
            $table->bigInteger('user_id');
            $table->string('contact_person');
            $table->string('contact_email');
            $table->string('contact_no');
            $table->string('interview_date');
            $table->string('interview_time');
            $table->text('instruction')->nullable();
            $table->smallInteger('application_status')->default(1);
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
        Schema::dropIfExists('interviews');
    }
}
