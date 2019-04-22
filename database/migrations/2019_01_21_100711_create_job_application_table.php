<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobApplication', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('job_id');
            $table->string('applicationStatus');
            $table->text('tags')->nullable();
            $table->text('comments')->nullable();
            $table->longText('questionnaire_answers')->nullable();
            $table->smallInteger('is_questionnaire_submit')->default(0);
            $table->smallInteger('followUp')->default(0);
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
        Schema::dropIfExists('jobApplication');
    }
}
