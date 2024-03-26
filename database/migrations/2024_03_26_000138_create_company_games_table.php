<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_games', function (Blueprint $table) {
            $table->id();
            $table->integer('stock');
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('game_id');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('game_id')->references('id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_games');
    }
}
