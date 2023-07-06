<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_configuration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('config_group_id');
            $table->string('configuration_title')->nullable();
            $table->text('note')->nullable();
            $table->string('identifier')->nullable();
            $table->text('configuration_value')->nullable();
            $table->string('control_type')->nullable();
            $table->string('parent_config_id')->nullable();
            $table->string('documentation_redirect_text')->nullable();
            $table->string('documentation_redirect_url')->nullable();
            $table->timestamps();
            $table->string('identifier_key')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_configuration');
    }
}
