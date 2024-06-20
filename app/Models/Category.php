<?php

namespace App\Models;

use
    Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function job()
    {
        return $this->hasMany(Job::class);
    }
}
