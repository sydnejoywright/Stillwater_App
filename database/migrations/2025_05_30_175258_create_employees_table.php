<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->foreign('person_id')->references('id')->on('people')->onDelete('set null');

            $table->string('position')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
