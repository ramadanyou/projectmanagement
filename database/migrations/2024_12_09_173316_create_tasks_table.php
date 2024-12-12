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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('priority', ['LOW', 'MEDIUM', 'HIGH'])->default('LOW');
            $table->enum('status', ['TODO', 'INPROGRESS', 'COMPLETED'])->default('TODO');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('description');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
