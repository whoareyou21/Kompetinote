<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('campus_email')->unique()->nullable();
            $table->string('personal_email')->unique()->nullable();
            $table->string('nim')->nullable();
            $table->string('nik')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('semester')->nullable();
            $table->string('account_number')->nullable();
            $table->string('profile_picture_path')->nullable();
            $table->string('profile_picture_name')->nullable();
            $table->string('faculty')->nullable();
            $table->string('study_program')->nullable();

            // $table->uuid('faculty_id');
            // $table->foreign('faculty_id')->references('faculties')->on('id');
            // $table->uuid('study_program_id');
            // $table->foreign('study_program_id')->references('study_programs')->on('id');
            $table->uuid('role_id');
            $table->foreign('role_id')->references('id')->on('roles');

            $table->string('password');
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
