<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            // Tierra / Mar (para niños: "tierra" o "mar")
            $table->string('environment', 10)->default('tierra')->after('photo_url');

            // mamifero, reptil, anfibio, ave, pez
            $table->string('animal_type', 15)->default('mamifero')->after('environment');

            // Datos simples de ficha técnica
            $table->string('scientific_name')->nullable()->after('habitat');
            $table->string('diet')->nullable()->after('scientific_name');
            $table->unsignedSmallInteger('lifespan_years')->nullable()->after('diet');
            $table->unsignedSmallInteger('size_cm')->nullable()->after('lifespan_years');
            $table->decimal('weight_kg', 6, 2)->nullable()->after('size_cm');
        });
    }

    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn([
                'environment',
                'animal_type',
                'scientific_name',
                'diet',
                'lifespan_years',
                'size_cm',
                'weight_kg',
            ]);
        });
    }
};
