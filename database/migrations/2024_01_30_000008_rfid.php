<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rfid extends Migration
{
    public function up()
    {
        Schema::create('Rfid', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Rfid_tag');
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('Rfid');
    }
}
