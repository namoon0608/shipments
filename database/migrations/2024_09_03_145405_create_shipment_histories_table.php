<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipment_id');  // Use unsignedBigInteger to match the primary key type in shipments table
            $table->foreign('shipment_id')->references('shipment_id')->on('shipments')->onDelete('cascade');  // Reference shipment_id
            $table->text('changes');
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
        Schema::dropIfExists('shipment_histories');
    }
}