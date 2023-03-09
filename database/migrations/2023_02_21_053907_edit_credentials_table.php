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
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('bookingPrice', 'booking_price');
            $table->renameColumn('contentTopic', 'content_topic');
            $table->string('fullname');
            $table->string('description')->nullable();
            $table->string('title_for_job')->nullable();
            $table->dropColumn('brandName');
    });       
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credentials', function (Blueprint $table) {            
        });
    }
};
