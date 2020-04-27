<?php

namespace ADR\User\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User.
 *
 * @package namespace ADR\User\Domain\Entities;
 */
class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
