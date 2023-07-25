<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $table = 'parent';

    protected $fillable =  [
        'parent_type',
        'parent_name',
        'barangay_id',
        'municipal_id',
        'province_id',
    ];



}
