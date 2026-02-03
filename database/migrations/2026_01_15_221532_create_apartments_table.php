<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('internal_number')->nullable();

            $table->string('street_address');
            $table->string('postal_code', 10);
            $table->string('city');
            $table->string('state')->nullable();

            $table->string('floor')->nullable();
            $table->integer('rooms');
            $table->integer('size_sqm');
            $table->integer('year_built')->nullable();

            $table->decimal('rent_cold', 10, 2);
            $table->decimal('rent_warm', 10, 2);
            $table->decimal('deposit', 10, 2)->nullable();

            $table->foreignId('apartment_status_id')
                ->constrained('apartment_statuses');

            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
