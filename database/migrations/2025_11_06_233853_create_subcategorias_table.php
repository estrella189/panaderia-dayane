<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_categoria');
            $table->string('nombre', 100);
            $table->timestamps();

            $table->foreign('id_categoria')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('subcategorias');
    }
};

