<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->text('body');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('topic_id')->unsigned()->default(0)->index()->comment('所属专题,0代表无专题');
            $table->integer('sort')->unsigned()->default(1)->index()->comment('用于专题排序');
            $table->integer('comment_count')->unsigned()->default(0)->comment('评论数量');
            $table->integer('view_count')->unsigned()->default(0)->comment('查看总数');
            $table->integer('order')->unsigned()->default(0)->comment('排序');
            $table->tinyInteger('is_show')->default(1)->comment('是否显示');
            $table->text('excerpt')->nullable()->comment('文章摘要，SEO 优化时使用');
            $table->string('slug')->nullable()->index()->comment('SEO 友好的 URI');
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
        Schema::dropIfExists('posts');
    }
}
