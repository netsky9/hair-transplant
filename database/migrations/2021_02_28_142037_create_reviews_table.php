<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('clinica_id')->unsigned();
            $table->text('text');
            $table->integer('rating');

            $table->foreign('user_id')->references('id')->on('users');

            /**
             * При удалении клиники удаляем и отзывы о ней
             */
            $table->foreign('clinica_id')
                ->references('id')
                ->on('clinics')
                ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
