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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['m', 'f', 'd']);
            $table->date('birthday');

            $table->foreignId('house_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('blood_status_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('diploma_id')->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();

            $table->date('enrollment_date');
            $table->date('graduation_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
