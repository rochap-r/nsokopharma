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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('dci');
            $table->string('dosage')->nullable();
            $table->string('forme_galenique')->nullable();

            // Les valeurs sont gérées via Enum au niveau applicatif,
            // mais stockées sous forme de string en BDD.
            $table->string('type');
            $table->string('personne')->nullable();

            $table->foreignId('category_id');

            $table->foreignId('aisle_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
