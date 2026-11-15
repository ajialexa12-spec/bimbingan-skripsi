<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('dosens', function (Blueprint $t) {
            $t->id();
            $t->string('nama');
            $t->string('nidn')->unique();
            $t->string('email')->nullable();
            $t->timestamps();
        });
        Schema::create('mahasiswas', function (Blueprint $t) {
            $t->id();
            $t->string('nama');
            $t->string('nim')->unique();
            $t->string('email');
            $t->string('program_studi');
            $t->foreignId('dosen_id')->constrained('dosens')->cascadeOnDelete();
            $t->string('status')->default('Aktif');
            $t->timestamps();
        });
        Schema::create('skripsis', function (Blueprint $t) {
            $t->id();
            $t->foreignId('mahasiswa_id')->constrained()->cascadeOnDelete();
            $t->string('judul');
            $t->string('status')->default('Proses');
            $t->unsignedTinyInteger('progress')->default(0);
            $t->timestamps();
        });
        Schema::create('bimbingans', function (Blueprint $t) {
            $t->id();
            $t->foreignId('mahasiswa_id')->constrained()->cascadeOnDelete();
            $t->foreignId('dosen_id')->constrained()->cascadeOnDelete();
            $t->date('tanggal');
            $t->time('jam')->nullable();
            $t->string('topik');
            $t->string('status')->default('Menunggu');
            $t->text('catatan')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('bimbingans');
        Schema::dropIfExists('skripsis');
        Schema::dropIfExists('mahasiswas');
        Schema::dropIfExists('dosens');
    }
};
