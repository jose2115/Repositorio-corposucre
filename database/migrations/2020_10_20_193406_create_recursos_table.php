<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('recursos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("tema");
            $table->unsignedBigInteger("id_programa");
            $table->foreign("id_programa")->references("id")->on("programas");
            $table->integer("semestre");
            $table->string("descripcion");
            $table->string("institucion");
            $table->string("año");
            $table->unsignedBigInteger("id_tipo_archivo");
            $table->foreign("id_tipo_archivo")->references("id")->on("archivos");
            $table->string("url");
            $table->string("autores");
            $table->string("archivo");
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
        Schema::dropIfExists('recursos');
    }
}
