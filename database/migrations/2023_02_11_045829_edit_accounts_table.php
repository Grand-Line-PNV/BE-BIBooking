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
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('gender')->nullable()->change();
            $table->string('fullname', 50)->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('address_line1')->nullable()->change();
            $table->string('address_line2')->nullable()->change();
            $table->string('address_line3')->nullable()->change();
            $table->string('address_line4')->nullable()->change();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
        });
    }
};
