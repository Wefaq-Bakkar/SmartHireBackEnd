<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;


class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'salary',
        'city_id',
        'country_id',
        'category_id',
        'type',
        'datePosted',
        'user_id',
        'status',
    ];
    /**
     * Get the category associated with the job.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the city associated with the job.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the user associated with the job.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }


    public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }
        if (isset($filters['city_id'])) {
            $query->where('city_id', $filters['city_id']);
        }
        if (isset($filters['country_id'])) {
            $query->where('country_id', $filters['country_id']);
        }
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['datePosted'])) {
            $query->whereDate('datePosted', $filters['datePosted']);
        }
        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $query->whereBetween('datePosted', [$filters['start_date'], $filters['end_date']]);
        }
        if (isset($filters['sort_by']) && isset($filters['sort_order'])) {
            $query->orderBy($filters['sort_by'], $filters['sort_order']);
        }
        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        if (isset($filters['min_salary']) && isset($filters['max_salary'])) {
            $query->whereBetween('salary', [$filters['min_salary'], $filters['max_salary']]);
        }
        if (isset($filters['specialist_id'])) {
            $query->where('user_id', $filters['specialist_id']);
        }
        return $query;
    }
}