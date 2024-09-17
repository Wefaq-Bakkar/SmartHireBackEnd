<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\support\Facades\Auth;
use App\Models\Job;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'specialist_id', 'id');
    }

    public function seekerApplications()
    {
        return $this->hasMany(Application::class, 'seeker_id', 'id');
    }
    public function interviews()
    {
        return $this->hasMany(Interview::class, 'specialist_id','id');
    }
    public function seekerInterviews()
    {
        return $this->hasMany(Interview::class, 'seeker_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'specialist_id','id');
    }
    public function seekerOffers()
    {
        return $this->hasMany(Offer::class, 'seeker_id', 'id');
    }

    public function resume()
    {
        return $this->hasOne(Resume::class);
    }


    public function scopeFilter(Builder $query, array $filters)
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (isset($filters['accepted'])) {
            $query->where('accepted', $filters['accepted']);
        }
    }
}
