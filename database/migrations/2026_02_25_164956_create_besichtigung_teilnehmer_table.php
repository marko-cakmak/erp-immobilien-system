<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('besichtigung_teilnehmer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('besichtigung_id')
                ->constrained('besichtigungen')
                ->cascadeOnDelete();
            $table->foreignId('interested_person_id')
                ->constrained('interested_persons')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('besichtigung_teilnehmer');
    }
};
