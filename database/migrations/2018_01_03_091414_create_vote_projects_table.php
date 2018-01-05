<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteProjectsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vote_projects', function(Blueprint $table) {
            $table->increments('id')->comment('投票主题编号');
            $table->string('name')->comment('投票主题');
            $table->text('slide')->nullable()->comment('投票主题幻灯片');
            $table->text('desc')->nullable()->comment('投票说明');
            $table->timestamp('start')->nullable()->comment('开始日期');
            $table->timestamp('end')->nullable()->comment('结束日期');
            $table->unsignedTinyInteger('status')->default(0)->comment('活动状态 0-关闭 1-启用');
            $table->integer('visitd')->default(0)->comment('访问量');
            $table->integer('involved')->default(0)->comment('参与者数量');
            $table->integer('voted')->default(0)->comment('投票数量');
            $table->unsignedTinyInteger('vote_rule')->nullable()->comment('投票规则编号');
            $table->timestamps();
            $table->softDeletes();
		});

        Schema::create('vote_rule', function(Blueprint $table) {
            $table->increments('id')->comment('投票规则编号');
            $table->string('name')->comment('投票规则名称');
            $table->text('payload')->comment('投票详细规则');
            $table->timestamps();
        });

        Schema::create('vote_item', function(Blueprint $table) {
            $table->increments('id')->comment('参与者编号');
            $table->integer('vote_projects_id')->comment('投票主题编号');
            $table->string('openid')->comment('参与者微信openid');
            $table->string('main_image')->comment('主图');
            $table->text('images')->comment('投票图片');
            $table->string('name')->comment('图片标题');
            $table->text('desc')->nullable()->comment('图片描述');
            $table->integer('voted')->default(0)->comment('投票数量');
            $table->unsignedTinyInteger('status')->default(0)->comment('审核状态 0-未审核 1-审核通过 2 锁定');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vote_record', function(Blueprint $table) {
            $table->increments('id')->comment('记录编号');
            $table->integer('vote_item_id')->comment('投票项编号');
            $table->string('openid')->comment('投票者微信openid');
            $table->timestamps();
            $table->softDeletes();
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('vote_projects');
        Schema::dropIfExists('vote_rule');
        Schema::dropIfExists('vote_item');
        Schema::dropIfExists('vote_record');
	}

}
