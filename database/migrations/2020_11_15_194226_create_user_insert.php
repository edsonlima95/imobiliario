<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB;
class CreateUserInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $password = bcrypt('12345');
        DB::table('users')->insert([
            'name'=>'edson',
            'email'=>'edsonlimacode@gmail.com',
            'password'=> $password,
            'document'=>'04761565306',
            'civil_status' => 'single'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete("DELETE FROM users WHERE email = ?",['edsonlimacode@gmail.com']);
    }
}
