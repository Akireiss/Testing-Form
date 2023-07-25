<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anecdotal extends Model
{
    use HasFactory;

    protected $table = 'anecdotal';

    protected $fillable = [
        'student_id',
        'case'
    ];
}
