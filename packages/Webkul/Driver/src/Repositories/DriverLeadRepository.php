<?php

namespace Webkul\Driver\Repositories;

use Webkul\Core\Eloquent\Repository;

class DriverLeadRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Driver\Contracts\DriverLead';
    }

    /**
     * Get Driver Details
     */
    public function getDriverDetails()
    {
        return $this
                ->leftJoin('drivers', 'drivers.id', 'driver_lead.driver_id')
                ->where('driver_lead.driver_id', request()->input('driver_id'))
                ->where('driver_lead.lead_id', request()->input('lead_id'))
                ->first();
    }
}