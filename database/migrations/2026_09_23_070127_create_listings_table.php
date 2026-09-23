<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();

            /*
             * Owner
             */
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /*
             * Category
             */
            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->foreignId('subcategory_id')
                ->constrained('subcategories')
                ->restrictOnDelete();

            /*
             * Location
             */
            $table->foreignId('country_id')
                ->constrained('countries')
                ->restrictOnDelete();

            $table->foreignId('state_id')
                ->constrained('states')
                ->restrictOnDelete();

            $table->foreignId('city_id')
                ->constrained('cities')
                ->restrictOnDelete();

            $table->foreignId('area_id')
                ->constrained('areas')
                ->restrictOnDelete();

            /*
             * Listing information
             */
            $table->enum('type', [
                'product',
                'service'
            ]);

            $table->string('name');

            $table->string('slug')->unique();

            $table->text('detail');

            $table->decimal('price', 12, 2);

            $table->enum('status', [
                'active',
                'inactive',
                'sold'
            ])->default('active');

            $table->timestamps();

            /*
             * Indexes for listing/filter pages
             */
            $table->index(['city_id', 'status']);
            $table->index(['category_id', 'status']);
            $table->index(['city_id', 'category_id', 'status']);
            $table->index(['user_id', 'status']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
