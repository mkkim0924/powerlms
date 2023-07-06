<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id');
            $table->integer('user_id');
            $table->integer('bundle_user_id')->nullable();
            $table->double('progress', 8, 2)->default(0);
            $table->boolean('paid_status')->default(false);
            $table->boolean('subscription_payment')->default(false);
            $table->dateTime('payment_completed_at')->nullable();
            $table->integer('access_sections_count')->default(0);
            $table->date('certificate_date')->nullable();
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
        Schema::dropIfExists('course_users');
    }
}
