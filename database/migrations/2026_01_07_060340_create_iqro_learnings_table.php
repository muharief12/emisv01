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
        Schema::create('iqro_learnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('student_id');
            $table->foreignId('journals_id')->constrained('journals')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('level', [1, 2, 3, 4, 5, 6]);
            $table->integer('start_page');
            $table->integer('end_page');
            $table->text('note')->nullable();
            $table->enum('status', ['good', 'retake']);
            $table->timestamps();

            // Foreign Key
            $table->foreign('teacher_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('student_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iqro_learnings');
    }
};
