<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quran_learnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('student_id');
            $table->foreignId('journals_id')->constrained('journals')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('quran_start_id');
            $table->integer('start_ayah');
            $table->integer('start_page');
            $table->unsignedBigInteger('quran_end_id');
            $table->integer('end_ayah');
            $table->integer('end_page');
            $table->text('note')->nullable();
            $table->enum('status', ['good', 'retake']);
            $table->timestamps();

            // Foreign Key
            $table->foreign('teacher_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('student_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('quran_start_id')->references('id')->on('qurans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('quran_end_id')->references('id')->on('qurans')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quran_learnings');
    }
};
