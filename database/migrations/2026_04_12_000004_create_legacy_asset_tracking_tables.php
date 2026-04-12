<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLegacyAssetTrackingTables extends Migration
{
    public function up()
    {
        Schema::create('email_queue', function (Blueprint $table) {
            $table->bigIncrements('email_queue_id');
            $table->integer('email_queue_user_id')->nullable();
            $table->text('email_queue_settings');
            $table->string('email_queue_template', 50);
            $table->tinyInteger('email_queue_priority')->default(5);
            $table->timestamp('email_queue_added_date')->useCurrent();
            $table->integer('email_queue_fail_times')->default(0);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('empty_logs', function (Blueprint $table) {
            $table->increments('empty_log_id');
            $table->string('empty_log_table_name')->nullable();
            $table->integer('empty_log_row_id')->nullable();
            $table->string('empty_log_action_on')->nullable();
            $table->integer('empty_log_number_of_fields')->nullable();
            $table->text('empty_log_fields')->nullable();
            $table->string('empty_log_image_empty_field')->default('');
        });

        Schema::create('estates', function (Blueprint $table) {
            $table->increments('estate_id');
            $table->unsignedInteger('estate_user_id');
            $table->string('estate_name')->nullable();
            $table->string('estate_owner_name')->nullable();
            $table->string('estate_address')->nullable();
            $table->string('estate_address2')->nullable();
            $table->string('estate_city')->nullable();
            $table->string('estate_zip')->nullable();
            $table->string('estate_state')->nullable();
            $table->text('estate_notes')->nullable();
            $table->tinyInteger('estate_is_primary_residence')->nullable();
            $table->tinyInteger('estate_does_own_home')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('estate_image')->default('');
            $table->string('action_on')->nullable();
        });

        Schema::create('pets', function (Blueprint $table) {
            $table->increments('pet_id');
            $table->integer('pet_owner_user_id');
            $table->string('pet_name')->nullable();
            $table->string('pet_gender', 50)->nullable();
            $table->string('pet_image')->default('');
            $table->string('pet_clinic_name')->nullable();
            $table->string('pet_description')->nullable();
            $table->string('pet_tag_id')->nullable();
            $table->string('pet_veterinarian_phone')->nullable();
            $table->date('pet_birth_day')->nullable();
            $table->string('pet_doctor_name')->nullable();
            $table->integer('pet_guardian')->nullable();
            $table->text('pet_notes')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('action_on')->nullable();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('profile_id');
            $table->integer('profile_user_id');
            $table->string('profile_first_name')->nullable();
            $table->string('profile_address2')->nullable();
            $table->string('profile_last_name')->nullable();
            $table->string('profile_email')->nullable();
            $table->string('profile_phone', 20)->nullable();
            $table->string('profile_phone2')->nullable();
            $table->string('profile_address')->nullable();
            $table->string('profile_city')->nullable();
            $table->string('profile_state')->nullable();
            $table->string('profile_zip')->nullable();
            $table->string('profile_gender', 25)->nullable();
            $table->date('profile_birth_day')->nullable();
            $table->string('profile_maritalStatus', 50)->nullable();
            $table->string('profile_nickName', 100)->nullable();
            $table->string('profile_dependents', 50)->nullable();
            $table->text('profile_profile_notes')->nullable();
            $table->string('profile_image')->default('');
            $table->text('profile_age')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('action_on')->nullable();
            $table->index('profile_email');
        });

        Schema::create('sites', function (Blueprint $table) {
            $table->increments('site_id');
            $table->unsignedInteger('site_owner_user_id');
            $table->string('site_name');
            $table->string('site_owners')->nullable();
            $table->string('site_image')->default('');
            $table->string('action_on')->nullable();
        });

        Schema::create('task_skips', function (Blueprint $table) {
            $table->bigIncrements('task_skip_id');
            $table->integer('task_skip_task_id')->nullable();
            $table->integer('task_skip_user_id')->nullable();
            $table->string('task_skip_sub_category')->default('');
            $table->tinyInteger('task_skip_status')->default(1)->comment('skipped = 1 , deleted = 2');
        });

        // Laravel 5.8 schema builder cannot express MySQL ON UPDATE CURRENT_TIMESTAMP for these legacy columns.
        DB::statement("ALTER TABLE email_queue MODIFY updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        DB::statement("ALTER TABLE estates MODIFY updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        DB::statement("ALTER TABLE pets MODIFY updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        DB::statement("ALTER TABLE profiles MODIFY updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    }

    public function down()
    {
        Schema::dropIfExists('task_skips');
        Schema::dropIfExists('sites');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('estates');
        Schema::dropIfExists('empty_logs');
        Schema::dropIfExists('email_queue');
    }
}
