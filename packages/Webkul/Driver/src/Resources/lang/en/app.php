<?php
    return [
        'datagrid' => [
            'email'      => 'Email',
            'first_name' => 'First Name',
            'last_name'  => 'Last Name',
            'name'       => 'Name',
            'phone'      => 'Phone',
            'title'      => 'Drivers',
        ],

        'lead' => [
            'form' => [
                'create' => [
                    'heading' => 'Driver Information',
                    'name'           => 'Name',
                    'phone'          => 'Phone',
                    'email'          => 'Email',
                    'cost'           => 'Cost ($)',
                    'tax'            => 'Tax ($)',
                    'gratuity'       => 'Gratuity ($)',
                    'extra-addons'   => 'Extra Addons ($)',
                    'total-cost'     => 'Total Cost ($)',
                    'source-of-lead' => 'Source of Lead',
                    'create'         => 'Create',
                    'edit'           => 'Edit',
                ],
            ],
            'view' => [
                'index' => [
                    'title'            => 'Driver Information',
                    'name'             => 'Name',
                    'email'            => 'Email',
                    'phone'            => 'Phone',
                    'cost'             => 'Cost',
                    'tax'              => 'Tax',
                    'gratuity'         => 'Gratuity',
                    'extra-addons'     => 'Extra Addons',
                    'total-cost'       => 'Total Cost',
                    'source-of-lead'   => 'Source Of Lead',
                    'no-records-found' => 'No Records Found',
                ],
            ],
        ],

        'common' => [
            'index' => [
                'title'  => 'Drivers',
                'create' => 'Create Driver',
            ],
            
            'create' => [
                'title'          => 'Create Driver',
                'save-btn-title' => 'Save Driver',
                'back'           => 'Back',
                'create-success' => 'Driver created successfully',
                'update-success' => 'Driver updated successfully.',
                'delete-success' => 'Driver deleted successfully.',
                'delete-failed'  => 'Driver can not be deleted.',
            ],

            'edit' => [
                'title'          => 'Update Driver',
                'save-btn-title' => 'Update Driver',
                'back'           => 'Back',
                'create-success' => 'Driver created successfully',
                'update-success' => 'Driver updated successfully.',
                'delete-success' => 'Driver deleted successfully.',
                'delete-failed'  => 'Driver can not be deleted.',
            ],
        ],

        'layouts' => [
            'title'  => 'Drivers',
            'edit'   => 'Edit Driver',
            'create' => 'Create Driver',
        ],

        'acl' => [
            'title'  => 'Driver',
            'create' => 'Create',
            'edit'   => 'Edit',
            'delete' => 'Delete',
        ],
    ];
?>
