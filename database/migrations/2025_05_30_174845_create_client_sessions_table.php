<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->string('client_note')->nullable();
            $table->boolean('in_alleva')->default(false);
            $table->unsignedBigInteger('note_assigned_to_id')->nullable();
            $table->string('care_level_id')->nullable();
        
            $table->foreign('session_id')->references('id')->on('session_histories')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('note_assigned_to_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('care_level_id')->references('level')->on('care_levels')->onDelete('set null');
        
            $table->primary(['session_id', 'client_id']);
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('client_session');
    }
};
