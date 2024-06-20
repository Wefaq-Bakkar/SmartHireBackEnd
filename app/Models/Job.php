<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use App\Models\Country;


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
}