<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_type_apartment_status_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_type_id')->constrained('task_types')->cascadeOnDelete();
            $table->foreignId('task_status_id')->constrained('task_statuses')->cascadeOnDelete();
            $table->foreignId('apartment_status_id')->constrained('apartment_statuses')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['task_type_id', 'task_status_id'], 'ttas_rules_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_type_apartment_status_rules');
    }
};
