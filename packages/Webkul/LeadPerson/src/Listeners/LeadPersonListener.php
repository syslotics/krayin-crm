<?php 

namespace Webkul\LeadPerson\Listeners;

use Illuminate\Support\Carbon;
use Webkul\Lead\Repositories\LeadRepository;
use Webkul\Contact\Repositories\PersonRepository;
use Webkul\Lead\Repositories\StageRepository;
use Webkul\LeadPerson\Repositories\LeadPersonRepository;

/**
 * CMD: php artisan lead:close
 */
class LeadPersonListener {

    /**
     * @var  $quote  Webkul\Lead\Repositories\LeadRepository
     */
    public function afterLeadUpdateOrCreate($lead) 
    {
        $data = request()->only([
            'persons.id',
            'persons.name',
            'persons.emails',
            'persons.contact_numbers',
            'persons.organization_id',
            'persons.service_type',
            'persons.vehicle_type',
            'persons.pickup_date',
            'persons.pickup_time',
            'persons.pickup_location',
            'persons.drop_location',
            'persons.pickup_airport',
            'persons.dropoff_airport',
        ]);

        $person = app(PersonRepository::class)->where('emails', 'like', "%" . request('persons.emails.0.value') . "%")->first();
    
        if(! $person) {
            $person = app(PersonRepository::class)->create([
                'name'            => $data['persons']['name'],
                'emails'          => $data['persons']['emails'],
                'contact_numbers' => $data['persons']['contact_numbers'],
            ]);
        } else {
            $person->update([
                'name'            => $data['persons']['name'] ?? '',
                'emails'          => $data['persons']['emails'] ?? [],
                'contact_numbers' => $data['persons']['contact_numbers'] ?? [],
            ]);
        }
    
        $data['persons']['person_id'] = $person->id;
        
        app(LeadPersonRepository::class)->updateOrCreate(['lead_id' => $lead->id, 'person_id' => $data['persons']['person_id']], $data['persons']);
    }

    /**
     * Lead Status Update
     */
    public function leadStatusUpdate()
    {
        $leadLoss = app(StageRepository::class)->findOneByField('code', 'lost');

        foreach (app(LeadRepository::class)->where('lead_pipeline_stage_id', '!=', $leadLoss->id)->all() as $lead) {
            if(\Carbon\Carbon::now()->greaterThan($lead->expected_close_date)) {
                $lead->lead_pipeline_stage_id = $leadLoss->id;

                $lead->save();
            }
        }
    }
}