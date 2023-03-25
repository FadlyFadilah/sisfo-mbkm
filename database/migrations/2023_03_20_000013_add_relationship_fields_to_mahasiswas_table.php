<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMahasiswasTable extends Migration
{
    public function up()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8211804')->references('id')->on('users');
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->foreign('prodi_id', 'prodi_fk_8211807')->references('id')->on('prodis');
            $table->unsignedBigInteger('periode_id')->nullable();
            $table->foreign('periode_id', 'periode_fk_8211810')->references('id')->on('periodes');
        });
    }
}