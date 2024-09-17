<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
class Hire extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'specialist_id',
        'seeker_id',
        'start_date',
        'end_date',
        'salary',
        'employment_type',

    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id');
    }

    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }
    public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['offer_id'])) {
            $query->where('offer_id', $filters['offer_id']);
        }
        if (isset($filters['specialist_id'])) {
            $query->where('specialist_id', $filters['specialist_id']);
        }
        if (isset($filters['seeker_id'])) {
            $query->where('seeker_id', $filters['seeker_id']);
        }
        if (isset($filters['start_date'])) {
            $query->where('start_date', '>=', $filters['start_date']);
        }
        if (isset($filters['end_date'])) {
            $query->where('end_date', '<=', $filters['end_date']);
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