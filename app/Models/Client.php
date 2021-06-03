<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\WithStatus;

class Client extends Model
{
    use HasFactory, SoftDeletes, WithStatus;

    /**
     * @var string[]
     */
    protected $appends = [
        'totalUser'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'client_name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'phone_no1',
        'phone_no2',
        'zip',
        'start_validity',
        'end_validity',
        'status'
    ];


    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @param $query
     * @param array $params
     */
    public function scopeSort(Builder $query, array $params = [])
    {
        $sort = $params['sort'] ?? null;
        $dir = isset($params['desc']) && $params['desc'] ? 'desc' : 'asc';
        if (!empty($sort) && in_array($sort,
                array_merge(['id', 'created_at', 'updated_at'], $this->fillable))) {
            $query->orderBy($sort, $dir);
        }
    }

    /**
     * @param $query
     * @param array $params
     */
    public function scopeFilter(Builder $query, array $params = [])
    {
        $filters = $params['filter'] ?? null;
        if (empty($filters)|| !is_array($filters)){
            return;
        }
        foreach ($filters as $filter => $value)
        if (!empty($filter) && in_array($filter,
                array_merge(['id', 'created_at', 'updated_at'], $this->fillable))) {
            $query->where($filter, '=', $value);
        }
    }

    /**
     * @return mixed
     */
    public function getTotalUserAttribute()
    {
        return $this->users()->active()->count();
    }
}
