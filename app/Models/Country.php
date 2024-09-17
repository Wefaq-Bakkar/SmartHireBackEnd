<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
    public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $query;
    }
}
