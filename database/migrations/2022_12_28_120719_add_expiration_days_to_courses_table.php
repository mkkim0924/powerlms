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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('expiration_days')->nullable()->after('course_status');
        });
        Schema::table('course_users', function (Blueprint $table) {
            $table->dateTime('expire_at')->nullable()->after('certificate_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('expiration_days');
        });
        Schema::table('course_users', function (Blueprint $table) {
            $table->dropColumn('expire_at');
        });
    }
};
