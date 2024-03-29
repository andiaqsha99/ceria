<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'id_class',
        'description',
        'location',
        'date'

    ];

    public function kelas() {
        $this->belongsTo('App\Models\Kelas', 'id_class');
    }
}
