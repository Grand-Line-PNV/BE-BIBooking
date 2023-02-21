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
       Schema::create('accounts', function (Blueprint $table) {
           $table->increments("id", true);
           $table->unsignedInteger('role_id');
           $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');        
           $table->unsignedInteger('file_id');
           $table->foreign('file_id')->references('id')->on('files')->onUpdate('cascade')->onDelete('cascade');        
           $table->string('username');
           $table->string('email',100)->unique;  
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
       Schema::dropIfExists('accounts');
   }
};


