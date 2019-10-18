<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('creator_id')->unsigned();
            $table->bigInteger('assigned_to_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('status_id')->references('id')->on('task_statuses');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('assigned_to_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
