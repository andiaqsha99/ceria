<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    use HasFactory;
    protected $table = 'group_chat';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'text',
        'date',
        'id_sender',
        'name',
        'id_class',
    ];

    public function kelas() {
        $this->belongsTo('App\Models\Kelas', 'id_class');
    }
}