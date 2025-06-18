<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'cv',
        'cover',
        'id_card',
        'additional',
        'student_apply_id',
    ];
}
