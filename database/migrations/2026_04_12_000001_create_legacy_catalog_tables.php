<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegacyCatalogTables extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('category_name', 50);
        });

        Schema::create('categories_sub', function (Blueprint $table) {
            $table->increments('category_sub_id');
            $table->string('category_sub_name', 50);
            $table->integer('category_key')->default(0);
        });

        Schema::create('document_content_types', function (Blueprint $table) {
            $table->unsignedInteger('document_content_type_id')->primary();
            $table->string('document_content_type_name', 50);
            $table->integer('document_content_type_sub_category');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->unsignedInteger('role_id')->primary();
            $table->string('role_name', 50)->nullable();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('task_id');
            $table->integer('task_priority')->default(100)->comment('100 is lowest');
            $table->text('task_message');
            $table->string('task_category');
            $table->string('task_main_url')->nullable();
            $table->string('task_button_text')->nullable();
            $table->string('task_popup_id')->nullable();
            $table->string('task_popup_title')->nullable();
            $table->text('task_popup_body')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('document_content_types');
        Schema::dropIfExists('categories_sub');
        Schema::dropIfExists('categories');
    }
}
