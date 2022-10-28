<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(); //title
            $table->string('alamat')->nullable(); //title
            $table->date('tanggal_lahir')->nullable(); //author
            $table->char('jenis_kelamin')->nullable(); //author
            $table->string('asal_sekolah')->nullable(); //author
            $table->integer('agama_id')->nullable(); //author
            $table->decimal('nilai_ind')->nullable(); //author
            $table->decimal('nilai_ipa')->nullable(); //author
            $table->decimal('nilai_mtk')->nullable(); //author
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
        Schema::dropIfExists('books');
    }
}
