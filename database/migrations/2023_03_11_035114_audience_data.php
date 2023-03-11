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
            Schema::create('audience_data', function (Blueprint $table) {
                $table->increments("id", true);
                $table->unsignedInteger('account_id');
                $table->foreign('account_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
                $table->integer('female');
                $table->integer('male');
                $table->integer('others');
                $table->integer('city1');
                $table->integer('city2');
                $table->integer('city3');
                $table->integer('city4');
                $table->integer('age1');
                $table->integer('age2');
                $table->integer('age3');
                $table->integer('age4');
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
        Schema::dropIfExists('audience_data');
    }
};
