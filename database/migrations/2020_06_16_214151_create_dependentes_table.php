<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependentes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('nome')->nullable(false);
            $table->text('email')->nullable(false);
            $table->integer('size');
            $table->text('file_name');
            $table->integer('status')->default(1);
            $table->date('dt_nascimento')->nullable(false);
            $table->bigInteger('cadastro_id')->unsigned();
            $table->foreign('cadastro_id')->references('id')->on('cadastros');
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
        Schema::dropIfExists('dependentes');
    }
}
