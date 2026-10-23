<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_outputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('attendance_id')->nullable()->constrained()->onDelete('set null');
            $table->string('task_name');
            $table->text('description')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('unit')->default('units');
            $table->decimal('quality_score', 5, 2)->nullable(); // 0.00 to 100.00
            $table->string('status')->default('pending'); // pending, completed, rejected
            $table->dateTime('completed_at')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            
            $table->index(['employee_id', 'attendance_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_outputs');
    }
};
