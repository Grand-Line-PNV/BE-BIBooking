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
    { {
            Schema::create('credentials', function (Blueprint $table) {
                $table->increments("id", true);
                $table->unsignedInteger('account_id');
                $table->foreign('account_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
                $table->string('gender');
                $table->string('phone_number');
                $table->string('address_line1');
                $table->string('address_line2');
                $table->string('address_line3');
                $table->string('address_line4');
                $table->string('nickname');
                $table->string('job')->nullable();
                $table->double('booking_price');
                $table->integer('experiences')->nullable();
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credentials');
    }
};
