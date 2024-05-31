<?php

namespace Webkul\Driver\Repositories;

use Webkul\Core\Eloquent\Repository;

class DriverRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Driver\Contracts\Driver';
    }
}