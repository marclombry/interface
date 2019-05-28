<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('bgcolor',30);
            $table->string('href');
            $table->integer('category_id');
            $table->string('type');
            $table->integer('box_id');
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
        Schema::dropIfExists('boxs');
    }
}
