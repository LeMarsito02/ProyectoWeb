<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade'); // Relación con clientes
            $table->decimal('total', 10, 2); // Total del pedido
            $table->decimal('tax', 8, 2); // IVA del pedido
            $table->string('delivery_type'); // Tipo de entrega: 'pickup' o 'delivery'
            $table->string('status')->default('pendiente'); // Estado del pedido
            $table->timestamps(); // timestamps: created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
