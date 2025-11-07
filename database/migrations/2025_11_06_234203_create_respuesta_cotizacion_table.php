<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('respuesta_cotizacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cotizacion_id');
            $table->unsignedBigInteger('admin_id'); // usuario con rol admin o empleado
            $table->decimal('precio_total', 10, 2)->nullable();
            $table->text('mensaje_admin')->nullable();
            $table->timestamp('fecha_respuesta')->useCurrent();
            $table->timestamps();

            // FK
            $table->foreign('cotizacion_id')
                  ->references('id')
                  ->on('cotizaciones')
                  ->onDelete('cascade');

            $table->foreign('admin_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('respuesta_cotizacion');
    }
};
