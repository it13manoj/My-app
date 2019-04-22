<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->increments('questionnaire_id');
            $table->string('questionnaire_title');
            $table->string('questionnaire_type')->nullable();
            $table->integer('submission_days')->nullable();
            $table->tinyInteger('accept_late_submission')->default(1);
            $table->tinyInteger('suffle_questions')->default(0);
            $table->tinyInteger('questionnaire_status')->default(1);
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
        Schema::dropIfExists('questionnaires');
    }
}
