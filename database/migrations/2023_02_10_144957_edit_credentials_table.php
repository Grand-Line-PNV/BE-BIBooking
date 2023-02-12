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
            $table->unsignedInteger('file_id')->after('id');
            $table->foreign('file_id')->references('id')->on('files')->onUpdate('cascade')->onDelete('cascade');
            $table->renameColumn('booking_price', 'bookingPrice');// Renaming "emp_name" to "employee_name"
            $table->renameColumn('started_working_date', 'startedWork');// Renaming "emp_name" to "employee_name"
            $table->date('dob')->after('nickname'); // Add "status" column
            $table->string('contentTopic')->after('dob'); // Add "status" column
            $table->string('industry')->after('contentTopic'); // Add "status" column
            $table->enum('marialStatus',array('married','single','divorced'))->after('industry'); // Add "status" column
            $table->string('link')->after('marialStatus'); // Add "status" column
            $table->string('brandName')->after('link'); // Add "status" column
            $table->string('website')->after('link'); // Add "status" column

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
