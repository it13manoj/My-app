<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_first_name');
            $table->string('user_last_name')->nullable();
            $table->string('user_username');
            $table->string('email')->unique();
            $table->string('user_contact')->nullable();
            $table->longText('user_about')->nullable();
            
            $table->enum('user_gender',['Male','Female','Other'])->nullable();
            $table->string('user_dob')->nullable();
            $table->string('user_profile_picture')->nullable();
            $table->enum('user_role',['Jobseeker','Employer','Consultant']);
            $table->string('user_address')->nullable();
            $table->bigInteger('user_company')->nullable();
            $table->string('user_token');
            $table->string('user_designation')->nullable();
            $table->string('user_id_proof')->nullable();
            $table->tinyInteger('user_status')->default(1);
            $table->tinyInteger('is_email_verified')->default(0);
            $table->tinyInteger('is_contact_verified')->default(0);
            $table->tinyInteger('blocked_by_admin')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->bigInteger('user_industry')->nullable();
            $table->bigInteger('user_functional_area')->nullable();
            $table->integer('user_experience_year')->nullable();
            $table->integer('user_experience_months')->nullable();
            $table->string('user_current_location')->nullable();
            $table->string('user_current_salary')->nullable();
            $table->string('user_expected_salary')->nullable();
            $table->string('user_prefered_location')->nullable();
            $table->tinyInteger('user_salary_confidential')->default(0);
            $table->tinyInteger('user_salary_negotiable')->default(0);
            $table->string('user_fb_id')->nullable();
            $table->string('user_fb_link')->nullable();
            $table->string('user_google_id')->nullable();
            $table->string('user_google_link')->nullable();
            $table->string('user_linkedin_id')->nullable();
            $table->string('user_linkedin_link')->nullable();
            $table->string('user_twitter_id')->nullable();
            $table->string('user_twitter_link')->nullable();
            $table->string('user_slug')->nullable();
            $table->string('user_profile_pic_thumb')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('user_can_edit_comp')->default(0);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
