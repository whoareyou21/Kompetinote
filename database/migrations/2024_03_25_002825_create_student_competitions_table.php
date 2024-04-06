<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_competitions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('achievement');

            $table->string('start_date');
            $table->string('end_date');

            $table->text('members')->nullable();
            $table->text('members_nim')->nullable();
            $table->integer('participant_number')->nullable();

            $table->string('assignment_letter_path')->nullable();
            $table->string('assignment_letter_name')->nullable();

            $table->string('certificate_path')->nullable();
            $table->string('certificate_name')->nullable();

            $table->string('organizer_url')->nullable();
            
            $table->string('handover_path')->nullable();
            $table->string('handover_name')->nullable();

            $table->string('other_document_path')->nullable();
            $table->string('other_document_name')->nullable();

            $table->string('description')->nullable();
            $table->string('rejection_note')->nullable();
            $table->integer('status')->default(0);
            
            $table->uuid('student_id');
            $table->foreign('student_id')->references('id')->on('users');
            
            $table->uuid('category_id');
            $table->foreign('category_id')->references('id')->on('category_competitions');

            $table->uuid('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('users');;
            
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
        Schema::dropIfExists('student_competitions');
    }
}
