<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->integer('course_user_id');
            $table->string('stripe_customer_id')->nullable();
            $table->string('subscription_id')->nullable();
            $table->double('subscription_price')->default(0);
            $table->string('plan_id')->nullable();
            $table->dateTime('subscription_start_date')->nullable();
            $table->dateTime('subscription_end_date')->nullable();
            $table->integer('subscription_installment_count')->default(1);
            $table->string('status')->nullable();
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
        Schema::dropIfExists('subscription_history');
    }
}
