<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_subcategoria');
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable(); // Ruta o nombre del archivo
            $table->timestamps();

            $table->foreign('id_subcategoria')
                  ->references('id')
                  ->on('subcategorias')
                  ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('productos');
    }
};
