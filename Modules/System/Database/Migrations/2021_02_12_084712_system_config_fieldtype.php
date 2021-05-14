<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemConfigFieldtype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('configuration_type', ['system_config', 'user_config'])->nullable()->default(null);
            $table->string('title')->nullable();
            $table->text('detail')->nullable();
            $table->string('key')->nullable()->unique();            
            $table->enum('field_type',['text_box','text_area','rich_text_box','checkbox','multiple_checkbox','radio_button','select_dropdown','image','file','number'])->nullable()->default('text_box');
            $table->text('options')->nullable();
            $table->boolean('status',1)->default(1);
            $table->boolean('user_configurable',1)->default(0);
            $table->boolean('for_developer',1)->default(0);
            $table->boolean('enable_view_for_user',1)->default(0);
            $table->string('group')->nullable();            
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
        Schema::dropIfExists('configuration_fields');
    }
}
