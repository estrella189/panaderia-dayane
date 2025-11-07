<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_producto');
            $table->text('detalles')->nullable();
            $table->decimal('precio', 10, 2)->nullable();
            $table->enum('estado', ['pendiente', 'cotizado'])->default('pendiente');
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('cotizaciones');
    }
};
