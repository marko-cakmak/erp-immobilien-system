<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('task_status_transition_assignee_rules', function (Blueprint $table) {
            $table->unsignedBigInteger('assignment_role_id')
                ->nullable()
                ->after('task_type_id');

            $table->foreign('assignment_role_id')
                ->references('id')
                ->on('task_assignment_roles')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('task_status_transition_assignee_rules', function (Blueprint $table) {
            $table->dropForeign(['assignment_role_id']);
            $table->dropColumn('assignment_role_id');
        });
    }
};
