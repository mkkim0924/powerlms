<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_survey_users_answers', function (Blueprint $table) {
            $table->dropColumn('answers');
        });
        Schema::rename('course_survey_users_answers', 'user_course_survey');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('user_course_survey', 'course_survey_users_answers');
        Schema::table('course_survey_users_answers', function (Blueprint $table) {
            $table->json('answers')->nullable()->after('survey_id');
        });
    }
};
