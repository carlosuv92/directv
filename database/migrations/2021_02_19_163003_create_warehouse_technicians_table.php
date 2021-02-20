<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_technicians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imei_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreignId('received')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('send_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('warehouse_technicians');
    }
}
