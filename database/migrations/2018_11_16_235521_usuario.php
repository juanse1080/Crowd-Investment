<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuario extends Migration {

    public function up(){

        Schema::create('solicitud', function (Blueprint $table) {
            $table->increments('pk_solicitud');
            $table->unsignedInteger('fk_usuario');
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('categoria');
            $table->boolean('estado')->default(true);
            $table->integer('monto_requerido');
            $table->integer('monto_juntado')->default(0);
            $table->float('interes');
            $table->integer('tiempo_devolucion');
            $table->timestamps();
        });

        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('pk_usuario');
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('password');
            $table->string('correo');
            $table->integer('cedula')->unique();
            $table->date('fecha_nacimiento');
            $table->string('nivel')->nullable();
            $table->integer('pasivos')->nullable();
            $table->integer('activos')->nullable();
            $table->boolean('empresa')->default(false);
            $table->timestamps();
        });

        Schema::create('multimedia', function (Blueprint $table) {
            $table->increments('pk_multimedia');
            $table->unsignedInteger('fk_solicitud');
            $table->text('descripcion')->nullable();
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('inversion', function (Blueprint $table) {
            $table->increments('pk_inversion');
            $table->unsignedInteger('fk_solicitud');
            $table->unsignedInteger('fk_usuario');
            $table->integer('monto');
            $table->timestamps();
        });

        Schema::create('notificacion', function (Blueprint $table) {
            $table->increments('pk_notificacion');
            $table->unsignedInteger('fk_usuario');
            $table->boolean('estado')->default(true);
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario');
        Schema::dropIfExists('solicitud');
        Schema::dropIfExists('multimedia');
        Schema::dropIfExists('inversion');
        Schema::dropIfExists('notificacion');
    }
}
