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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments("id", true);
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->string('campaign_status');
            $table->string('industry');
            $table->string('hashtag');
            $table->string('socialChannel');
            $table->integer('amount');
            $table->text('require');
            $table->text('interest');
            $table->text('description');
            $table->date('started_date');
            $table->date('ended_date');
            $table->double('price');
            $table->integer('applied_number')->default(0);
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
        Schema::dropIfExists('campaigns');
    }
};
