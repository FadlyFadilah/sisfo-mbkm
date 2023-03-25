<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLaporansTable extends Migration
{
    public function up()
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->unsignedBigInteger('pengajuan_id')->nullable();
            $table->foreign('pengajuan_id', 'pengajuan_fk_8211823')->references('id')->on('pengajuans');
        });
    }
}