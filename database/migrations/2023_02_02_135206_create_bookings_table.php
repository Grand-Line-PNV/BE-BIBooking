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
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments("id", true);
            $table->unsignedInteger('influencer_id');
            $table->foreign('influencer_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->enum("status", array('Todo', 'Doing', 'Done'));
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
        Schema::dropIfExists('bookings');
    }
};
