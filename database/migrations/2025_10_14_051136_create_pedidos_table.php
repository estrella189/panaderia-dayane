<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // === TABLA PEDIDOS ===
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            // Relación con usuarios (cliente que realiza el pedido)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Datos generales del pedido
            $table->date('fecha_entrega')->nullable();
            $table->text('notas')->nullable(); // mensaje o comentarios del cliente
            $table->enum('estado', [
                'pendiente',
                'confirmado',
                'preparando',
                'entregado',
                'cancelado'
            ])->default('pendiente');

            // Total acumulado del pedido
            $table->decimal('total', 10, 2)->default(0);

            $table->timestamps();
        });

        // === TABLA PEDIDO_ITEMS ===
        Schema::create('pedido_items', function (Blueprint $table) {
            $table->id();

            // Relación con pedidos
            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->cascadeOnDelete();

            // Relación con productos
            $table->foreignId('producto_id')
                  ->nullable()
                  ->constrained('productos')
                  ->nullOnDelete();

            // Detalles del producto dentro del pedido
            $table->string('producto_nombre')->nullable(); // útil si el producto no existe en BD
            $table->integer('cantidad')->default(1);
            $table->string('tamanio')->nullable();
            $table->string('sabor')->nullable();
            $table->decimal('precio_unitario', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido_items');
        Schema::dropIfExists('pedidos');
    }
};
