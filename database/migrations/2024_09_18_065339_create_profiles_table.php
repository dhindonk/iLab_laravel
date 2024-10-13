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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->string('image')->nullable();
            $table->string('full_name');
            $table->enum('gender', ['male', 'female']);
            $table->string('phone')->unique();
            $table->string('residential_address');
            $table->string('status');
            $table->string('student_identity_number')->nullable();
            $table->string('country_of_origin');
            $table->string('university_name');
            $table->string('affiliate');
            $table->string('university_address');
            $table->string('university_country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
