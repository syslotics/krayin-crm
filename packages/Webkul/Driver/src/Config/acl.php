<?php

return [
    [
        'key'   => 'drivers',
        'name'  => 'drivers::app.acl.title',
        'route' => 'drivers.information.index',
        'sort'  => 7,
    ], [
        'key'   => 'drivers.create',
        'name'  => 'drivers::app.acl.create',
        'route' => ['drivers.information.create', 'drivers.information.store'],
        'sort'  => 1,
    ], [
        'key'   => 'drivers.edit',
        'name'  => 'drivers::app.acl.edit',
        'route' => ['drivers.information.edit', 'drivers.information.update'],
        'sort'  => 2,
    ], [
        'key'   => 'drivers.delete',
        'name'  => 'drivers::app.acl.delete',
        'route' => ['drivers.information.delete', 'drivers.information.mass_delete'],
        'sort'  => 3,
    ]
];