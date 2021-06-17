<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadastroDependenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastro_dependente', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('cadastro_id')->unsigned();
            $table->foreign('cadastro_id')->references('id')->on('cadastros')->onDelete('cascade');
            $table->bigInteger('dependente_id')->unsigned();
            $table->foreign('dependente_id')->references('id')->on('dependentes')->onDelete('cascade');
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
        Schema::dropIfExists('cadastro_dependente');
    }
}
