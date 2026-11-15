<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Dosen extends Model {
    protected $fillable = ['nama', 'nidn', 'email', 'foto'];
    public function mahasiswas() { return $this->hasMany(Mahasiswa::class); }
    public function bimbingans() { return $this->hasMany(Bimbingan::class); }
}
