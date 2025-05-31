<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->foreign('person_id')->references('id')->on('people')->onDelete('set null');

            $table->unsignedBigInteger('case_manager_id')->nullable();
            $table->string('care_level_id')->nullable();
            $table->unsignedBigInteger('completed_hours')->default(0);
            $table->timestamps();
        
            $table->foreign('case_manager_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('care_level_id')->references('level')->on('care_levels')->onDelete('set null');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
