<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id');
            $table->integer('section_id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('short_content')->nullable();
            $table->longText('content')->nullable();
            $table->string('lesson_type')->nullable();
            $table->string('lesson_media_url')->nullable();
            $table->string('lesson_thumbnail_image')->nullable();
            $table->string('lesson_document_type')->nullable();
            $table->longText('lesson_content')->nullable();
            $table->time('time')->nullable();
            $table->boolean('free_lesson')->default(false);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('units');
    }
}
