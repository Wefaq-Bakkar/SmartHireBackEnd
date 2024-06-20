<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'application_status',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id','id');
    }

    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id','id');
    }

}
