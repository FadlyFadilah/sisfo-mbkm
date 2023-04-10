<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_program')->nullable();
            $table->longText('desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}