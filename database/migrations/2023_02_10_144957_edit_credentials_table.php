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
            $table->renameColumn('booking_price', 'bookingPrice');// Renaming "emp_name" to "employee_name"
            $table->date('dob')->after('nickname'); // Add "status" column
            $table->string('contentTopic')->after('dob'); 
            $table->string('industry')->after('dob'); // Add "status" column
            $table->string('brandName')->after('contentTopic'); // Add "status" column
            $table->string('website')->yafter('brandName'); // Add "status" column

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
