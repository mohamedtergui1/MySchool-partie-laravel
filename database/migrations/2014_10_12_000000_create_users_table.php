<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->default('myschool');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('image')->nullable();
            $table->enum('genre',["man","woman"])->default(null);
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->string('address')->nullable();
            $table->string('number_phone')->nullable();
            $table->date('date_d_inscription')->nullable();
            $table->foreignId("role_id")->constrained("roles");
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
