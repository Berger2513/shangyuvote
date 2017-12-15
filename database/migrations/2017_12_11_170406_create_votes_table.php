<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('投票标题');
            $table->text('content')->default('')->comment('投票内容');
            $table->string('create_time')->comment('投票标题');
            $table->string('end_time')->comment('投票标题');
            $table->integer('status')->comment('状态');
            $table->integer('max_num')->comment('最大选择数量');
        });

        Schema::create('vote_person', function (Blueprint $table) {
            // 被投票者
            $table->increments('id');
            $table->integer('vote_id')->comment('投票id');
            $table->integer('user_id')->comment('被投票者id');
            $table->integer('sorce')->default(0)->comment('投分');

        });

        Schema::create('vote_poler', function (Blueprint $table) {
            //投票者
            $table->increments('id');
            $table->string('vote_id')->comment('投票id');
            $table->integer('phone')->nullable()->comment('投票者shouji');
            $table->string('poler_id')->comment('投票者id');
            $table->string('vote_date')->comment('投票时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vote');
        Schema::drop('vote_person');
        Schema::drop('vote_poler');
    }
}
