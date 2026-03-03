<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_status_transition_assignee_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transition_id')->constrained('task_status_transitions')->onDelete('cascade');
            $table->foreignId('task_type_id')->constrained('task_types')->onDelete('cascade');
            $table->foreignId('activate_role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['transition_id', 'task_type_id'], 'tsta_rules_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_status_transition_assignee_rules');
    }
};
