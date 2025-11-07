<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_cotizacion');
            $table->enum('estado', ['pendiente', 'en_proceso', 'entregado'])->default('pendiente');
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_cotizacion')->references('id')->on('cotizaciones')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('pedidos');
    }
};
