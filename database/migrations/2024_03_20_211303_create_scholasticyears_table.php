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
        Schema::create('scholasticyears', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id")->constrained("users")->cascadeOnDelete();
            $table->bigInteger("classroom_id");
            $table->enum("fin_result", ["pass","redubl","current"])->default("current");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholasticyears');
    }
};
