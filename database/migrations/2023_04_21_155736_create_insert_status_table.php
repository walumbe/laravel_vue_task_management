<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('statuses')->insert([
            ['name' => 'In Progress'],
            ['name' => 'Completed'],
            ['name' => 'Not Assigned'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('statuses')->whereIn('name', ['In Progress', 'Completed', 'Not Assigned'])->delete();
    }
};
