<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kurum_id');
            $table->foreign('kurum_id')->references('id')->on('kurums')->onDelete('cascade');
            $table->string('quiz_uniqe_id');
            $table->foreign('quiz_uniqe_id')->references('uniqe_id')->on('quizzes')->onDelete('cascade');
            $table->string('fullname');
            $table->string('email');
            $table->bigInteger('phone');
            $table->longText('answers');
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
        Schema::dropIfExists('results');
    }
}
