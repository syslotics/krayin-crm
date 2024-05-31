<?php

namespace Webkul\Driver\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Driver\Contracts\Driver as DriverContract;

class Driver extends Model implements DriverContract
{
    /**
     * The table associated with the model.
     */
    protected $table = "drivers";

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * The attributes casts.
     */
    protected $casts = [
        'email' => 'array',
        'phone' => 'array',
    ];
}
