<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaggableTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('taggable.connection');

        if (!Schema::connection($connection)->hasTable('tags')) {
            Schema::connection($connection)->create('tags', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('normalized');
                $table->timestamps();

                $table->index('normalized');
            });
        }

        if (!Schema::connection($connection)->hasTable('taggables')) {
            Schema::connection($connection)->create('taggables', function (Blueprint $table) {
                $table->unsignedInteger('tag_id');
                $table->unsignedInteger('taggable_id');
                $table->string('taggable_type');
                $table->timestamps();

                $table->index(['tag_id', 'taggable_id'], 'i_taggable_fwd');
                $table->index(['taggable_id', 'tag_id'], 'i_taggable_rev');
                $table->index('taggable_type', 'i_taggable_type');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('taggable.connection');

        if (Schema::connection($connection)->hasTable('tags')) {
            Schema::connection($connection)->drop('tags');
        }

        if (Schema::connection($connection)->hasTable('taggables')) {
            Schema::connection($connection)->drop('taggables');
        }
    }
}
