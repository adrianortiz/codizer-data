<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDvarcharsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dvarchars', function (Blueprint $table) {
            $table->increments('id');

            $table->string('dtitle');
            $table->string('content');
            $table->integer('form_id');
            $table->integer('input_id');
            $table->integer('row_id');
            $table->enum('type_validation', ['val_text', 'val_date', 'val_num']);

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
        Schema::drop('dvarchars');
    }
}
