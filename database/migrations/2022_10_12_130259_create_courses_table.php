<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('instructor_id')->nullable();
            $table->string('stripe_price_id')->nullable();
            $table->integer('badge_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('tiny_description')->nullable();
            $table->longText('content')->nullable();
            $table->longText('requirements')->nullable();
            $table->longText('what_you_will_learn_points')->nullable();
            $table->longText('who_this_course_is_for_points')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_free')->default(false);
            $table->double('price', 8, 2)->default(0);
            $table->boolean('discount_flag')->default(false);
            $table->double('discounted_price', 8, 2)->default(0);
            $table->boolean('subscription_flag')->default(false);
            $table->double('subscription_price', 8, 2)->default(0);
            $table->string('subscription_interval')->default('0');
            $table->integer('subscription_interval_count')->default(1);
            $table->integer('subscription_installment_count')->default(1);
            $table->string('intro_video_provider')->nullable();
            $table->string('intro_video_url')->nullable();
            $table->string('intro_thumbnail_image')->nullable();
            $table->time('time')->default('00:00:00');
            $table->string('course_level')->nullable();
            $table->text('related_courses')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->longText('schema_script')->nullable();
            $table->text('welcome_message')->nullable();
            $table->text('congratulation_message')->nullable();
            $table->double('average_rating', 8, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_enrollments')->default(0);
            $table->integer('course_status')->default(0);
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
        Schema::dropIfExists('courses');
    }
}
