<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('care_levels', function (Blueprint $table) {
            $table->string('level')->primary();
            $table->unsignedBigInteger('required_hours')->default(0);
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('care_levels');
    }
};
