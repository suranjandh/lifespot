<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLegacyDocumentTables extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('document_id');
            $table->string('document_title')->nullable();
            $table->text('document_notes')->nullable();
            $table->string('document_file')->nullable();
            $table->unsignedInteger('document_owner_user_id');
            $table->integer('document_category')->default(0);
            $table->integer('document_category_sub')->default(0);
            $table->integer('document_category_sub_sub')->default(0);
            $table->timestamp('document_updated')->useCurrent();
            $table->integer('document_category_sub_sub_sub')->default(0);
            $table->integer('document_content_type')->default(0);
            $table->timestamp('document_created')->useCurrent();
            $table->tinyInteger('document_share_members_all')->default(0);
        });

        Schema::create('document_share_roles', function (Blueprint $table) {
            $table->increments('document_share_roles_id');
            $table->unsignedInteger('document_share_roles_role');
            $table->unsignedInteger('document_share_roles_document');
            $table->unsignedInteger('document_share_roles_user');
        });

        Schema::create('documents_not_applicable', function (Blueprint $table) {
            $table->increments('documents_not_applicable_id');
            $table->text('documents_not_applicable_hash');
            $table->unsignedInteger('documents_not_applicable_user_id');
        });

        Schema::create('documents_share', function (Blueprint $table) {
            $table->increments('docuemnt_share_id');
            $table->unsignedInteger('document_share_document_id');
            $table->unsignedInteger('document_share_member_id');
            $table->string('document_share_member_type', 50);
        });

        // Laravel 5.8 schema builder cannot express MySQL ON UPDATE CURRENT_TIMESTAMP for this legacy column.
        DB::statement("ALTER TABLE documents MODIFY document_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    }

    public function down()
    {
        Schema::dropIfExists('documents_share');
        Schema::dropIfExists('documents_not_applicable');
        Schema::dropIfExists('document_share_roles');
        Schema::dropIfExists('documents');
    }
}
