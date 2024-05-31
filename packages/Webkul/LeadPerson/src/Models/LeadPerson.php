<?php

namespace Webkul\LeadPerson\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\LeadPerson\Contracts\LeadPerson as LeadPersonContract;

class LeadPerson extends Model implements LeadPersonContract
{
    /**
     * The table associated with the model.
     */
    protected $table = "lead_person";

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'service_type',
        'vehicle_type',
        'pickup_date',
        'pickup_time',
        'pickup_location',
        'drop_location',
        'pickup_airport',
        'dropoff_airport',
        'person_id',
        'lead_id',
    ];
}
