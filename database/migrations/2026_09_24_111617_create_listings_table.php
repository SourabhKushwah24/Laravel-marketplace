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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('type', ['product', 'service']);

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('detail');

            $table->foreignId('category_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('subcategory_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('country_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('state_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('city_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('area_id')
                ->constrained()
                ->restrictOnDelete();

            $table->decimal('price', 12, 2);

            $table->string('status')->default('active');

            $table->timestamps();

            $table->index(['city_id', 'category_id']);
            $table->index(['category_id', 'subcategory_id']);
            $table->index(['city_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
