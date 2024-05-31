<?php

namespace Webkul\LeadPerson\Repositories;

use Webkul\Core\Eloquent\Repository;

class LeadPersonRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\LeadPerson\Contracts\LeadPerson';
    }
}