<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('session_staff', function (Blueprint $table) {
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('staff_id');
        
            $table->foreign('session_id')->references('id')->on('session_histories')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('employees')->onDelete('cascade');
        
            $table->primary(['session_id', 'staff_id']);
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('session_staff');
    }
};
