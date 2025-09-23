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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('IdProducto');
            $table->string('Nombre', 100);
            $table->string('Descripcion', 50)->nullable();
            $table->integer('Precio');
            $table->integer('Stock');
            $table->foreignId('IdCategoria')->constrained('categorias','IdCategoria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
