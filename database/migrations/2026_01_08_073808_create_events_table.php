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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->string('code')->unique();
            $table->string('name');
            $table->dateTime('schedule');
            $table->text('description')->nullable();
            $table->integer('cost')->default(0);
            $table->integer('total_payment')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('teacher_id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
