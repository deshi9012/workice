<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('assignee');
            $table->string('subject');
            $table->integer('duration')->default(0);
            $table->string('scheduled_date')->nullable();
            $table->string('type')->default('outbound');
            $table->text('result')->nullable();
            $table->longText('description')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->integer('reminder')->nullable(10);
            $table->dateTime('notified_at')->nullable();
            $table->morphs('phoneable');
            $table->softDeletes();
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
        Schema::dropIfExists('calls');
    }
}
