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
        Schema::create('tenant_inventories', function (Blueprint $table) {
            $table->id();
            // Identifiant du tenant (supposant qu'une table "tenants" existe ou via votre stratégie multi-tenant)
            $table->string('tenant_id');
            $table->foreignId('product_id')->onDelete('cascade');

            // Détails spécifiques au tenant
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('quantity')->default(0);

            // Emplacement personnalisé, ici nommé "custom_aisle_id"
            $table->unsignedBigInteger('custom_aisle_id')->nullable();
            $table->foreign('custom_aisle_id')->references('id')->on('aisles')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_inventories');
    }
};
