<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guide_id')->references('id')->on('guides')->onDelete('cascade');
            $table->string('imei', 18)->unique();// 15
            $table->string('card', 18)->unique();// 12
            $table->enum('type_warehouse', ['ALMACEN', 'CAMPO', 'VENDIDO', 'LOGISTICA INVERSA', 'ROBADO'])->default('ALMACEN');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
}
