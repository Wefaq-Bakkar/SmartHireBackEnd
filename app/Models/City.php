<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Job;

class City extends Model
{
    use HasFactory;

    protected $fillable=['name','country_id'];

    public function job()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Get the country that the city belongs to.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
