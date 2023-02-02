<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       Schema::create('booking_details', function (Blueprint $table) {
        $table->increments("id", true);
        $table->unsignedInteger('booking_id');
        $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('cascade');
        $table->unsignedInteger('file_id');
        $table->foreign('file_id')->references('id')->on('files')->onUpdate('cascade')->onDelete('cascade');
        $table->unsignedInteger('payment_id');
        $table->foreign('payment_id')->references('id')->on('payments')->onUpdate('cascade')->onDelete('cascade');
        $table->date("booking_date");
        $table->date("started_date");
        $table->date("ended_date");
        $table->boolean("payment_status");
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
       Schema::dropIfExists('booking_details');
   }
};







