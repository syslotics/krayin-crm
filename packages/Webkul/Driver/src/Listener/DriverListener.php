<?php

namespace Webkul\Driver\Listener;

use Webkul\Driver\Repositories\DriverRepository;
use Webkul\Driver\Repositories\DriverLeadRepository;

class DriverListener {
    /**
     * Create driver after lead
     */
    public function leadCreateAfter($lead) 
    {
        $data = request()->only([
            "drivers.name",
            "drivers.phone",
            "drivers.email",
            "drivers.driver_id",
            "drivers.cost",
            "drivers.tax",
            "drivers.gratuity",
            "drivers.extra_addons",
            "drivers.total_cost",
            "drivers.source_of_lead",
        ]);
        
        if(empty($data)) {
            return false;
        }

        $driver = app(DriverRepository::class)->where('email', 'like', "%" . request('drivers.email.0.value') . "%")->first();
       
        if(! $driver) {
            $driver = app(DriverRepository::class)->create([
                'name'  => $data['drivers']['name'],
                'email' => $data['drivers']['email'],
                'phone' => $data['drivers']['phone'],
            ]);

        } else {
            $driver->update($data['drivers']);
        }

        $data['drivers']['driver_id'] = $driver->id;

        app(DriverLeadRepository::class)->updateOrCreate(['lead_id' => $lead->id], [
            'lead_id'        => $lead->id,
            'driver_id'      => $data['drivers']['driver_id'],
            'cost'           => $data['drivers']['cost'] ?? 0,
            'tax'            => $data['drivers']['tax'] ?? 0,
            'gratuity'       => $data['drivers']['gratuity'] ?? 0,
            'extra_addons'   => $data['drivers']['extra_addons'] ?? 0,
            'total_cost'     => $data['drivers']['total_cost'] ?? 0,
            'source_of_lead' => $data['drivers']['source_of_lead'] ?? 0,
        ]);
    }
}