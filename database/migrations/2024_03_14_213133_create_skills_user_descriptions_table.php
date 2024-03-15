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
        Schema::create('skills_user_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skills_user_id');
            $table->text('description');
            $table->timestamps();

            $table->index('skills_user_id');
            $table->foreign('skills_user_id')->references('id')->on('skills_user')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skills_user_descriptions');
    }
};
