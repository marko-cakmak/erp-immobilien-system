<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_type_assignment_role_config', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_type_id')
                ->constrained('task_types')
                ->onDelete('cascade');

            $table->foreignId('assignment_role_id')
                ->constrained('task_assignment_roles')
                ->onDelete('cascade');

            $table->boolean('is_active_on_creation')->default(true);

            $table->timestamps();

            $table->unique(['task_type_id', 'assignment_role_id'], 'task_type_role_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_type_assignment_role_config');
    }
};
