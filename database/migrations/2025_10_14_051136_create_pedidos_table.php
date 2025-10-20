<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('pedidos', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->date('fecha_entrega')->nullable();
      $table->text('notas')->nullable(); // mensaje en el pastel / indicaciones
      $table->enum('estado', ['pendiente','confirmado','preparando','entregado','cancelado'])
            ->default('pendiente');
      $table->decimal('total', 10, 2)->default(0);
      $table->timestamps();
    });

    Schema::create('pedido_items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('pedido_id')->constrained('pedidos')->cascadeOnDelete();

      // SIN tabla productos: guardamos el nombre en "personalizacion"
      $table->unsignedBigInteger('producto_id')->nullable(); // por si luego agregas productos
      $table->integer('cantidad')->default(1);
      $table->decimal('precio_unit', 10, 2)->default(0);
      $table->json('personalizacion')->nullable(); // {nombre, tamano, sabor, ...}
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('pedido_items');
    Schema::dropIfExists('pedidos');
  }
};

