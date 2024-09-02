<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status')->unique();
            $table->timestamps();
        });

        Schema::table('shipments', function  (Blueprint $table) {
            $table->string('status');
            $table->foreign('status')->references('status')->on('statused')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function  (Blueprint $table) {
            $table->dropForeign(['status']);
            $table->dropColumn('status');
        });

        Schema::dropIfExists('statuses');
    }
}