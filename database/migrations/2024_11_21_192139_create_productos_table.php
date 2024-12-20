<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del producto
            $table->string('category'); // Categoría como pizza, bebida, postre
            $table->integer('price'); // Precio del producto
            $table->string('image'); // URL de la imagen del producto
            $table->text('availableDescription'); // Descripción del producto
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
        Schema::dropIfExists('productos');
    }
}
