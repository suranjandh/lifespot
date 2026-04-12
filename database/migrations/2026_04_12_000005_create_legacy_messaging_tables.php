<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLegacyMessagingTables extends Migration
{
    public function up()
    {
        Schema::create('message_channels', function (Blueprint $table) {
            $table->increments('message_channel_id');
            $table->tinyInteger('message_channel_type')->default(1)->comment('1 - single 2 -group');
            $table->integer('message_channel_owner_user')->nullable();
            $table->integer('message_channel_sender')->nullable();
            $table->integer('message_channel_count')->default(1);
        });

        Schema::create('message_groups', function (Blueprint $table) {
            $table->increments('message_group_id');
            $table->unsignedInteger('message_group_owner_user_id');
            $table->string('message_group_name', 50)->nullable();
            $table->string('message_group_members_user_ids')->nullable();
        });

        Schema::create('message_group_members', function (Blueprint $table) {
            $table->increments('message_group_members_id');
            $table->unsignedInteger('message_group_members_group_id');
            $table->unsignedInteger('message_group_members_user_id');
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('message_id');
            $table->text('message_content');
            $table->unsignedInteger('message_from_user');
            $table->unsignedInteger('message_to_user');
            $table->integer('message_message_group_id')->nullable();
            $table->string('message_image')->nullable();
            $table->string('message_attachment')->nullable();
            $table->timestamp('message_created_time')->useCurrent();
        });

        // Laravel 5.8 schema builder cannot express MySQL ON UPDATE CURRENT_TIMESTAMP for this legacy column.
        DB::statement("ALTER TABLE messages MODIFY message_created_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    }

    public function down()
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('message_group_members');
        Schema::dropIfExists('message_groups');
        Schema::dropIfExists('message_channels');
    }
}
