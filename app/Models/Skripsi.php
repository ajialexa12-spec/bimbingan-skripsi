<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Skripsi extends Model {
    protected $fillable = ['mahasiswa_id', 'judul', 'status', 'progress', 'file_pdf'];
    public function mahasiswa() { return $this->belongsTo(Mahasiswa::class); }
}
