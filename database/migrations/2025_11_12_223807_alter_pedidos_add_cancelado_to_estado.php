<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE pedidos
            MODIFY estado ENUM('pendiente','en_proceso','entregado','cancelado')
            NOT NULL DEFAULT 'pendiente'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE pedidos
            MODIFY estado ENUM('pendiente','en_proceso','entregado')
            NOT NULL DEFAULT 'pendiente'
        ");
    }
};
