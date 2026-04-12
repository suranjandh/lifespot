<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLegacyPeopleTables extends Migration
{
    public function up()
    {
        Schema::create('guardian_member', function (Blueprint $table) {
            $table->increments('guardian_member_id');
            $table->integer('guardian_member_dependent');
            $table->integer('guardian_member_guardian');
        });

        Schema::create('members', function (Blueprint $table) {
            $table->increments('member_id');
            $table->integer('member_owner_user_id');
            $table->string('member_first_name')->nullable();
            $table->string('member_last_name')->nullable();
            $table->string('member_email')->nullable();
            $table->string('member_phone', 20)->nullable();
            $table->string('member_address')->nullable();
            $table->string('member_address2')->nullable();
            $table->string('member_city')->nullable();
            $table->string('member_state')->nullable();
            $table->string('member_zip')->nullable();
            $table->string('member_gender', 25)->nullable();
            $table->string('member_maritalStatus', 50)->nullable();
            $table->string('member_nickName', 100)->nullable();
            $table->tinyInteger('member_dependents')->nullable();
            $table->string('member_image')->default('');
            $table->string('member_role_in_estate')->nullable();
            $table->string('member_relationship_to_owner')->nullable();
            $table->date('member_anniversary')->nullable();
            $table->text('member_special_notes')->nullable();
            $table->tinyInteger('member_is_dependent')->default(0);
            $table->tinyInteger('member_is_spouse')->default(0);
            $table->tinyInteger('member_is_beneficiary')->default(0);
            $table->tinyInteger('member_is_emergency_contact')->default(0);
            $table->tinyInteger('member_is_friend')->default(0);
            $table->tinyInteger('isAssociatedWithCoTrustee')->default(0);
            $table->string('member_phone2')->nullable();
            $table->date('member_birth_day')->nullable();
            $table->tinyInteger('isAssociatedWithSpouse')->default(0);
            $table->integer('member_associated_user')->default(0);
            $table->tinyInteger('member_invitation_status')->default(0);
            $table->tinyInteger('member_join_account_access')->default(0);
            $table->string('member_gifts')->nullable();
            $table->text('member_age')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('member_guardian_member_id')->nullable();
            $table->string('action_on')->nullable();
        });

        Schema::create('dependent_medicals', function (Blueprint $table) {
            $table->integer('dependent_medical_member_id')->primary();
            $table->string('dependent_medical_primary_care')->nullable();
            $table->string('dependent_medical_name', 50)->nullable();
            $table->string('dependent_medical_email', 50)->nullable();
            $table->string('dependent_medical_phone')->nullable();
            $table->string('dependent_medical_web')->nullable();
            $table->string('dependent_medical_address')->nullable();
            $table->string('dependent_medical_address2')->nullable();
            $table->string('dependent_medical_city')->nullable();
            $table->string('dependent_medical_state')->nullable();
            $table->string('dependent_medical_zip', 30)->nullable();
            $table->text('dependent_medical_special_notes')->nullable();
            $table->string('dependent_medical_image')->nullable();
            $table->string('action_on')->nullable();
        });

        Schema::create('dependent_schools', function (Blueprint $table) {
            $table->integer('dependent_school_member_id')->primary();
            $table->string('dependent_school_name', 50)->nullable();
            $table->string('dependent_school_grade')->nullable();
            $table->string('dependent_school_email', 50)->nullable();
            $table->string('dependent_school_phone')->nullable();
            $table->string('dependent_school_counselor')->nullable();
            $table->string('dependent_school_address')->nullable();
            $table->string('dependent_school_address2')->nullable();
            $table->string('dependent_school_city')->nullable();
            $table->string('dependent_school_state')->nullable();
            $table->string('dependent_school_zip', 30)->nullable();
            $table->text('dependent_school_special_notes')->nullable();
            $table->string('dependent_school_image')->nullable();
            $table->string('action_on')->nullable();
        });

        Schema::create('members_share', function (Blueprint $table) {
            $table->increments('member_share_id');
            $table->unsignedInteger('member_share_to_member_id');
            $table->unsignedInteger('member_shared_member_id');
            $table->string('member_share_member_type');
        });

        Schema::create('roles_members', function (Blueprint $table) {
            $table->bigIncrements('roles_members_roles_id');
            $table->integer('roles_members_member');
            $table->integer('roles_members_role');
        });

        // Laravel 5.8 schema builder cannot express MySQL ON UPDATE CURRENT_TIMESTAMP for this legacy column.
        DB::statement("ALTER TABLE members MODIFY updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    }

    public function down()
    {
        Schema::dropIfExists('roles_members');
        Schema::dropIfExists('members_share');
        Schema::dropIfExists('dependent_schools');
        Schema::dropIfExists('dependent_medicals');
        Schema::dropIfExists('members');
        Schema::dropIfExists('guardian_member');
    }
}
