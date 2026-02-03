<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('apartment_interests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('interested_person_id')
                ->constrained('interested_persons')
                ->onDelete('cascade');

            $table->foreignId('apartment_id')
                ->constrained('apartments')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['interested_person_id', 'apartment_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apartment_interests');
    }
};
