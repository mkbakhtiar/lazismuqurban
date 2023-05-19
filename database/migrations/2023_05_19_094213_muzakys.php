<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Muzakys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muzakys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('npwz');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address');
            $table->integer('staf_id');
            $table->string('nik');
            $table->string('handphone', 30);
            $table->string('gender', 2);
            $table->string('muzaky_type', 20);
            $table->string('muzaky_status', 2);
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
        Schema::dropIfExists('muzakys');
    }
}
