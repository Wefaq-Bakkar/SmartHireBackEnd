<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\city;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function city()
    {
        return $this->hasMany(City::class);
    }
    public function job()
    {
        return $this->hasMany(Job::class);
    }

}
