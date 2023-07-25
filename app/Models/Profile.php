<?php

namespace App\Models;

use App\Models\EducBg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    protected $table ='profile';


    protected $fillable = [
        'student_id',
        'dissability',
        'food_allergy'
    ];


    public function siblings() {
        return $this->hasMany(Sibling::class);
    }

    public function address() {
        return $this->hasMany(Address::class);
    }

    public function guardians() {
        return $this->hasMany(Guardian::class);
    }

    public function education() {
        return $this->hasMany(EducBg::class);
    }

    public function parentstatus() {
        return $this->hasMany(ParentStatus::class);
    }
    public function vitamins() {
        return $this->hasMany(Vitamin::class);
    }




}
