<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutTable extends Migration
{
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Untuk judul atau nama perusahaan
            $table->text('description'); // Untuk deskripsi tentang perusahaan
            $table->timestamps(); // Menyimpan waktu dibuat dan diupdate
        });
    }

    public function down()
    {
        Schema::dropIfExists('about');
    }
};


