<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (isset($filters['country_id'])) {
            $query->where('country_id', $filters['country_id']);
        }

        return $query;
    }
}
