<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id');
            $table->integer('section_id');
            $table->integer('curriculum_list_id');
            $table->string('curriculum_type')->nullable();
            $table->string('name')->nullable();
            $table->string('curriculum_slug')->nullable();
            $table->string('course_slug')->nullable();
            $table->time('time')->nullable();
            $table->integer('sort_order')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('has_pending_comments')->default(false);
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
        Schema::dropIfExists('curriculum');
    }
}
