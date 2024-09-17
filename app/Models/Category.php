<?php

namespace App\Models;

use
    Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Job;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
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
