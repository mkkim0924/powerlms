<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorPayoutLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_payout_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('instructor_id');
            $table->integer('course_id')->nullable();
            $table->integer('payment_transaction_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->double('price', 8, 2)->default(0);
            $table->boolean('payout_request_status')->default(false);
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
        Schema::dropIfExists('instructor_payout_logs');
    }
}
