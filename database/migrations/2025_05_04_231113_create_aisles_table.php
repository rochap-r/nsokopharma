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
        Schema::create('aisles', function (Blueprint $table) {
            $table->id();
            $table->string('code'); // Par exemple : "A1", "B3", etc.
            // Optionnel : un aisle peut être lié à une catégorie pour des recommandations d'emplacement
            $table->foreignIdFor(\App\Models\Category::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aisles');
    }
};
