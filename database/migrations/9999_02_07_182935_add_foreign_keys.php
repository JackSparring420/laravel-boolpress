<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function(Blueprint $table){
            $table -> foreign('category_id', 'posts_cat')
                   -> references('id')
                   -> on('categories');
        });

        Schema::table('post_tag', function(Blueprint $table){
            $table -> foreign('post_id', 'post_id')
                   -> references('id')
                   -> on('posts');

            $table -> foreign('tag_id', 'tag_id')
                    -> references('id')
                    -> on('tags');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function(Blueprint $table){
            $table->dropForeign('posts_cat');
        });

        Schema::table('post_tag', function(Blueprint $table){
            $table->dropForeign('post_id');
            $table->dropForeign('tag_id');
        });
    }
}
