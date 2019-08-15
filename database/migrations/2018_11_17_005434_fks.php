<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fks extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::table('solicitud', function (Blueprint $table) {
            $table->foreign('fk_usuario')->references('pk_usuario')->on('usuario')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('multimedia', function (Blueprint $table) {
            $table->foreign('fk_solicitud')->references('pk_solicitud')->on('solicitud')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('inversion', function (Blueprint $table) {
            $table->foreign('fk_solicitud')->references('pk_solicitud')->on('solicitud')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('fk_usuario')->references('pk_usuario')->on('usuario');
            
        });

        Schema::table('notificacion', function (Blueprint $table) {
            $table->foreign('fk_usuario')->references('pk_usuario')->on('usuario')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }
     
    public function down(){
        // Schema::dropIfExists('fks');
    }
}
