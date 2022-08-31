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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable(false);
            $table->string('position', 50)->nullable(false);
            $table->unsignedBigInteger('number')->nullable(false); //unsignedBigInteger: inteiro positivo
            $table->string('country', 100)->nullable(false);
            $table->timestamp('born_at')->nullable(); //nascido em/permite valor nullo
            $table->unsignedBigInteger('team_id'); //chave estrangeira da tabela 'teams'
            $table->foreign('team_id')->references('id')->on('teams'); //foreign key (referência)
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
        Schema::dropIfExists('players');
    }
};
