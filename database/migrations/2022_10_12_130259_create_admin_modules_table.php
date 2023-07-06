<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('module_key')->nullable();
            $table->string('module_title')->nullable();
            $table->string('icon_class')->nullable();
            $table->string('route_name')->nullable();
            $table->string('description')->nullable();
            $table->integer('parent_module')->nullable();
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
        Schema::dropIfExists('admin_modules');
    }
}
