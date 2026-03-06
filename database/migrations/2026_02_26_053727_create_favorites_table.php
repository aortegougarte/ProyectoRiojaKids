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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();

            // usuario dueño del favorito
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // tipo de favorito (animal o video)
            $table->string('item_type');

            // id del animal o video
            $table->unsignedBigInteger('item_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
