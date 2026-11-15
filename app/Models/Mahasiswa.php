<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Mahasiswa extends Model {
    protected $fillable = ['nama', 'nim', 'email', 'program_studi', 'dosen_id', 'status'];
    public function dosen() { return $this->belongsTo(Dosen::class); }
    public function skripsi() { return $this->hasOne(Skripsi::class); }
    public function bimbingans() { return $this->hasMany(Bimbingan::class); }
}
