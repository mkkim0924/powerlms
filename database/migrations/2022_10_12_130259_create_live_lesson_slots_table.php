<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveLessonSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_lesson_slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('live_lesson_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->string('meeting_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->integer('duration')->nullable();
            $table->string('password')->nullable();
            $table->text('start_url')->nullable();
            $table->text('join_url')->nullable();
            $table->integer('remaining_seats')->default(100);
            $table->boolean('reminder_sent')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_lesson_slots');
    }
}
