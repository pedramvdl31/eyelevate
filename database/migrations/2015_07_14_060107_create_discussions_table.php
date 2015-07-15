<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('thread_id',false)->nullable();
            $table->unsignedInteger('user_id',false)->nullable();
            $table->string('title', 100)->nullable();
            $table->text('body')->nullable();
            $table->text('spam')->nullable();
            $table->tinyInteger('status')->nullable();
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
        //
    }
}
