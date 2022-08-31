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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()->nullable(false); //não vai ser repetido(unique), não aceita valor nullo(nullable(false))
            $table->unsignedBigInteger('foundation_year')->nullable(false);//unsignedBigInteger: inteiro que não tem sinal, ou seja, apenas números positivos
            $table->string('country', 100)->nullable(false);
            $table->timestamps();
        });
        //nome
        //ano de fundação
        //país
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
};
