<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->timestamps();

            $table->index('email');

        });

        DB::table('users')->insert([
            'name' => 'Azzarnuji',
            'email' => 'azzar@gmail.com',
            'password'=>password_hash("123456",PASSWORD_DEFAULT),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
