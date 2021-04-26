<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = 'file';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'path',
        'date_upload',
        'user_upload',
        'id_folder'
    ];
}
