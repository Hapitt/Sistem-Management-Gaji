<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id('id_jabatan');
            $table->string('jabatan', 50);
            $table->integer('gaji_pokok');
            $table->integer('tunjangan');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
