<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPengajuansTable extends Migration
{
    public function up()
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->nullable();
            $table->foreign('mahasiswa_id', 'mahasiswa_fk_8211815')->references('id')->on('mahasiswas');
            $table->unsignedBigInteger('program_id')->nullable();
            $table->foreign('program_id', 'program_fk_8211816')->references('id')->on('programs');
        });
    }
}