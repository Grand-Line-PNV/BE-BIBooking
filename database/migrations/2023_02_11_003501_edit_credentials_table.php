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
            $table->string('nickname')->nullable()->change();// Renaming "emp_name" to "employee_name"
            $table->double('bookingPrice')->nullable()->change();// Renaming "emp_name" to "employee_name"
            $table->string('contentTopic')->nullable()->change(); // Add "status" column
            $table->string('industry')->nullable()->change(); // Add "status" column
            $table->string('brandName')->nullable()->change(); // Add "status" column
            $table->string('website')->nullable()->change();
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
