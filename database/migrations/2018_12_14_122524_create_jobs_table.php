<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('job_id');
            $table->text('job_title');
            $table->bigInteger('job_user_id');
            $table->bigInteger('job_company_id');
            $table->longText('job_description')->nullable();
            $table->longText('job_responsibility')->nullable();
            $table->text('reject_reason')->nullable();
            $table->bigInteger('job_category');
            $table->bigInteger('job_sub_category');
            $table->bigInteger('job_offered_salary_min');
            $table->bigInteger('job_offered_salary_max');
            $table->string('job_experience');
            $table->string('job_p_category');
            $table->string('job_qualification');
            $table->integer('job_vacancy');
            $table->string('job_graduation_start_year')->nullable();
            $table->string('published_on')->nullable();
           
            $table->string('job_graduation_end_year')->nullable();
            $table->string('job_type')->nullable();
            $table->string('job_shift')->nullable();
            $table->text('job_preference')->nullable();
            $table->string('job_career_level')->nullable();
            $table->string('job_role')->nullable();
            $table->text('job_skills')->nullable();
            $table->text('job_benefits')->nullable();
            $table->text('job_keywords')->nullable();
            $table->bigInteger('job_questionnaire')->nullable();
            $table->dateTime('job_last_applying_date');
            $table->dateTime('job_expiry_date');
            $table->bigInteger('job_country')->nullable();
            $table->bigInteger('job_state')->nullable();
            $table->bigInteger('job_city')->nullable();
            $table->text('job_address');
            $table->string('job_event')->nullable();
            $table->string('min_exp')->nullable();
            $table->string('max_exp')->nullable();
            $table->dateTime('job_event_start_date')->nullable();
            $table->dateTime('job_event_end_date')->nullable();
            $table->integer('job_event_number_of_companies')->nullable();
            $table->text('job_event_companies')->nullable();
            $table->integer('job_status')->default(0);
            $table->tinyInteger('job_is_salary_disclosed')->default(0);
            $table->tinyInteger('job_is_deleted')->default(0);
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
        Schema::dropIfExists('jobs');
    }
}
