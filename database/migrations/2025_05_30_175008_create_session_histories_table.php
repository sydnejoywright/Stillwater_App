<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('session_histories', function (Blueprint $table) {
            $table->id();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->unsignedBigInteger('leader_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->boolean('shift_note_complete')->default(false);
            $table->date('date');
            $table->timestamps();
        
            $table->foreign('leader_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('session_histories');
    }
};
