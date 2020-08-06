<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuiveTesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suive_tes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('Tractionnaire');
            $table->datetime('RTS_time')->nullable();
            $table->string('Plate_Number')->nullable();
            $table->string('Van’s_type')->nullable();
            $table->string('Origin')->nullable();
            $table->string('Destination')->nullable();
            $table->dateTime('RTS_request_Time')->nullable();
            $table->dateTime('RTS_closing_Time')->nullable();
            $table->string('Positionning_time')->nullable();
            $table->dateTime('Van_arrival_Time')->nullable();
            $table->dateTime('Invoice_sharing_time')->nullable();
            $table->dateTime('Warehouse_exit')->nullable();
            $table->dateTime('CustomsClearance')->nullable();
            $table->dateTime('Port_exit')->nullable();
            $table->dateTime('Arrival_Time')->nullable();
            $table->dateTime('Unloading_time')->nullable();
            $table->dateTime('Immobilisation_Loading')->nullable();
            $table->dateTime('Immobilisation_Unloading')->nullable();
            $table->string('Comments_trspt_team')->nullable();
            $table->string('List_of_shipment_nbrs')->nullable();
            $table->string('Nbr_of_DNs')->nullable();
            $table->dateTime('AEP_validation_Time')->nullable();
            $table->string('WH_comments')->nullable();
            $table->string('Transportation_comments')->nullable();
            $table->string('Weight')->nullable();
            $table->string('Volume')->nullable();
            $table->string('Poids_Taxable')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suive_tes');
    }
}
