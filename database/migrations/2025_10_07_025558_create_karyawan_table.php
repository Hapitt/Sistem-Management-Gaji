<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_rating');
            $table->string('nama', 50);
            $table->string('divisi', 50);
            $table->text('alamat');
            $table->string('umur', 2);
            $table->string('jenis_kelamin', 10);
            $table->string('status', 20);
            $table->string('foto', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan')->onDelete('cascade');
            $table->foreign('id_rating')->references('id_rating')->on('rating')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
