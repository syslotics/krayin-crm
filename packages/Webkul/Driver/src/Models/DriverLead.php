<?php

namespace Webkul\Driver\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Driver\Contracts\DriverLead as DriverLeadContract;

class DriverLead extends Model implements DriverLeadContract
{
    /**
     * The table associated with the model.
     */
    protected $table = "driver_lead";

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'driver_id',
        'lead_id',
        'phone',
        'cost',
        'tax',
        'gratuity',
        'extra_addons',
        'total_cost',
        'source_of_lead',
    ];

    /**
     * Get the person that owns the lead.
     */
    public function driver()
    {
        return $this->belongsTo(DriverProxy::modelClass());
    }
}
