<?php

namespace App\Models;

use App\Models\Anecdotal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'first_name',
        'last_name'
    ];

    public function anecdotal()
    {
        return $this->hasMany(Anecdotal::class, 'student_id');
    }


}
