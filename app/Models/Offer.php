<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'interview_id',
        'seeker_id',
        'specialist_id',
        'status',
        'salary',
        'startdate',
        'expiredate',
        'employment_type',
    ];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id','id');
    }

    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id','id');
    }
    public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['interview_id'])) {
            $query->where('interview_id', $filters['interview_id']);
        }
        if (isset($filters['specialist_id'])) {
            $query->where('specialist_id', $filters['specialist_id']);
        }
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['salary'])) {
            $query->where('salary', $filters['salary']);
        }
        if (isset($filters['startdate'])) {
            $query->where('startdate', '>=', $filters['startdate']);
        }
        if (isset($filters['expiredate'])) {
            $query->where('expiredate', '<=', $filters['expiredate']);
        }
        if (isset($filters['employment_type'])) {
            $query->where('employment_type', $filters['employment_type']);
        }
        if (isset($filters['sort_by']) && isset($filters['sort_order'])) {
            $query->orderBy($filters['sort_by'], $filters['sort_order']);
        }
        return $query;
    }
}