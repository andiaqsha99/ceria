<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $table = 'child';
    protected $primaryKey = 'nomor_induk';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
    	'nomor_induk',
    	'nik_parent',
    	'id_kelas',
    	'nama',
        'notification_token'
    ];

    public function parents() {
        $this->belongsTo('App\Models\Parents', 'nik_parent');
    }

    public function kelas() {
        $this->belongsTo('App\Models\Kelas', 'id_kelas');
    }

    public function attendance() {
        $this->hasMany('App\Models\Attendance', 'nomor_induk');
    }
}
