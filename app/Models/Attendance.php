<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_class',
        'nomor_induk',
        'tanggal',
        'status_kehadiran',
        'deskripsi'
    ];

    public function child() {
        $this->belongsTo('App\Models\Child', 'nomor_induk');
    }

    public function kelas() {
        $this->belongsTo('App\Models\Kelas', 'id_class');
    }
}
