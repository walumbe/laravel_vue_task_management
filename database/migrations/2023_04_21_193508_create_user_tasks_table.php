<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->bigIncrements('id', 11);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->timestamp('due_date');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->string('remarks', 100);
            $table->unsignedBigInteger('status_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade');;
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('cascade');;
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
        Schema::dropIfExists('user_tasks');
    }
}
