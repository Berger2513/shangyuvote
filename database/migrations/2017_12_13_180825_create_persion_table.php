<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('persion', function (Blueprint $table) {
            //投票者
            $table->increments('id');
            $table->string('name')->comment('候选人');
            $table->integer('vote_id')->comment('投票id');
            $table->string('avatar')->comment('候选人头像');
            $table->text('content')->comment('内容');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('persion');
    }
}
