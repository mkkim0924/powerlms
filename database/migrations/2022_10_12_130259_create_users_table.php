<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('stripe_customer_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('type')->default(0);
            $table->text('application_reject_reason')->nullable();
            $table->string('mobile_number')->nullable();
            $table->text('experience')->nullable();
            $table->text('bio')->nullable();
            $table->text('address')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_routing_number')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->boolean('enable_course_review')->default(false);
            $table->text('bank_address')->nullable();
            $table->text('instructor_application_message')->nullable();
            $table->integer('instructor_application_status')->default(0);
            $table->integer('instructor_block_status')->default(0);
            $table->double('system_revenue_percentage', 8, 2)->nullable();
            $table->boolean('custom_payout_setting_enable')->default(false);
            $table->double('instructor_pending_amount', 8, 2)->default(0);
            $table->double('instructor_payout_amount', 8, 2)->default(0);
            $table->string('image')->nullable();
            $table->longText('instructor_zoom_details')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('activation_token')->nullable();
            $table->boolean('is_active')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
