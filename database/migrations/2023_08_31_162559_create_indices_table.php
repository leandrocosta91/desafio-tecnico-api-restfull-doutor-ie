<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indices', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('livro_id')->nullable();
            $table->foreign('livro_id')->references('id')->on('livros');

            $table->unsignedBigInteger('indice_pai')->nullable();
            $table->foreign('indice_pai')->references('id')->on('indices');

            $table->string('titulo');

            $table->integer('pagina');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indices');
    }
}
