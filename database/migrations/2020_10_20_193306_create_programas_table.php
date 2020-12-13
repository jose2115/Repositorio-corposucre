<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('programas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("nombre");
            $table->unsignedBigInteger("id_facultad");
            $table->foreign("id_facultad")->references("id")->on("facultades");
    
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
        Schema::dropIfExists('programas');
    }
}
