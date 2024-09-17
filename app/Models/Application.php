<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'seeker_id',
        'specialist_id',
        'application_status',
        'Matching_percentage',
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
    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }
   public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['job_id'])) {
            $query->where('job_id', $filters['job_id']);
        }
        if (isset($filters['seeker_id'])) {
            $query->where('seeker_id', $filters['seeker_id']);
        }
        if (isset($filters['specialist_id'])) {
            $query->where('specialist_id', $filters['specialist_id']);
        }
        if (isset($filters['application_status'])) {
            $query->where('application_status', $filters['application_status']);
        }
        if (isset($filters['created_at'])) {
            $query->whereDate('created_at', $filters['created_at']);
        }
        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
        }
        if (isset($filters['sort_by']) && isset($filters['sort_order'])) {
            $query->orderBy($filters['sort_by'], $filters['sort_order']);
        }

        return $query;
    }

}
