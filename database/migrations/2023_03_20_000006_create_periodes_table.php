<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodesTable extends Migration
{
    public function up()
    {
        Schema::create('periodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tahun_periode');
            $table->string('status')->default('Tidak Aktif');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}