<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('description');

            $table->string('salle');

            $table->string('user_email');

            $table->integer('states')->default(2);

            $table->datetime('start_time');

            $table->datetime('end_time');

            $table->string('recurrence');

            $table->timestamps();

            $table->softDeletes();

        });
    }
}
