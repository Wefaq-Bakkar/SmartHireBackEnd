<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'seeker_id',
        'specialist_id',
        'date_from',
        'date_to',
        'location',
        'status',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id','id');
    }

    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id','id');
    }
    public function offeres()
    {
        return $this->hasMany(Offer::class);
    }
    public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['application_id'])) {
            $query->where('application_id', $filters['application_id']);
        }
        if (isset($filters['job_id'])) {
            $query->where('job_id', $filters['job_id']);
        }
        if (isset($filters['seeker_id'])) {
            $query->where('seeker_id', $filters['seeker_id']);
        }
        if (isset($filters['specialist_id'])) {
            $query->where('specialist_id', $filters['specialist_id']);
        }
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['date_from'])) {
            $query->where('date_from', '>=', $filters['date_from']);
        }
        if (isset($filters['date_to'])) {
            $query->where('date_to', '<=', $filters['date_to']);
        }
        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $query->whereBetween('date_from', [$filters['start_date'], $filters['end_date']]);
        }
        if (isset($filters['sort_by']) && isset($filters['sort_order'])) {
            $query->orderBy($filters['sort_by'], $filters['sort_order']);
        }
        return $query;
    }
}