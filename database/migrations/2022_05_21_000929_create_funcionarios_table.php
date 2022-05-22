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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('foto_perfil')->nullable();
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('cpf')->unique();
            $table->string('rg')->nullable();
            $table->tinyInteger('sexo')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->double('salario')->nullable();
            $table->foreignId('cargo')->constrained('cargos')->onUpdate('cascade')->onDelete('cascade');
            $table->string('cep')->nullable();
            $table->string('uf')->nullable();
            $table->string('cidade')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('complemento')->nullable();
            $table->string('numero')->nullable();
            $table->longText('obs')->nullable();
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
        Schema::dropIfExists('funcionarios');
    }
};
