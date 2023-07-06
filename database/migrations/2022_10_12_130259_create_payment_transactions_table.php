<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->string('module_type')->nullable();
            $table->integer('module_user_id')->nullable();
            $table->double('price', 8, 2)->default(0);
            $table->double('system_revenue', 8, 2)->default(0);
            $table->double('system_revenue_percentage', 8, 2)->default(0);
            $table->double('tax_percentage', 8, 2)->default(0);
            $table->double('system_revenue_tax_price', 8, 2)->default(0);
            $table->double('tax_price', 8, 2)->default(0);
            $table->double('instructor_revenue', 8, 2)->default(0);
            $table->string('payment_type')->nullable();
            $table->string('payment_id')->nullable();
            $table->longText('payment_response')->nullable();
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
        Schema::dropIfExists('payment_transactions');
    }
}
