<?php

return [
    [
         'key'   => 'general.stripe',
         'name'  => 'stripe::app.configuration.heading',
         'sort'  => 2,
         'fields' => [
             [
                 'name'          => 'active',
                 'title'         => 'stripe::app.configuration.status',
                 'type'          => 'boolean',
                 'value'         =>  null,
                 'channel_based' => true,
                 'locale_based'  => true,
             ], [
                 'name'          => 'title',
                 'title'         => 'stripe::app.configuration.title',
                 'type'          => 'text',
                 'depend'        => 'active:1',
                 'validation'    => 'required_if:active,1',
                 'value'         =>  null,
                 'channel_based' =>  true,
                 'locale_based'  =>  true,
            ], [
                'name'       => 'currency',
                'title'      => 'stripe::app.configuration.currency-code',
                'type'       => 'select',
                'validation' => 'required',
                'options' => [
                    [
                        'title' => 'USD',
                        'value' => 'usd',
                    ], [
                        'title' => 'INR',
                        'value' => 'inr',
                    ], [
                        'title' => 'EUR',
                        'value' => 'eur',
                    ], [
                        'title' => 'YER',
                        'value' => 'yer',
                    ], [
                        'title' => 'VND',
                        'value' => 'vnd',
                    ], [
                        'title' => 'AED',
                        'value' => 'aed',
                    ],
                ],               
            ], [
                 'name'          => 'description',
                 'title'         => 'stripe::app.configuration.description',
                 'type'          => 'textarea',
                 'channel_based' =>  true,
                 'locale_based'  =>  true,
            ], [
                 'name'  => 'debug',
                 'title' => 'stripe::app.configuration.debug',
                 'type'  => 'select',
                 'options' => [
                     [
                         'title' => 'Sandbox',
                         'value' => 'sandbox',
                     ], [
                         'title' => 'Production',
                         'value' => 'production',
                     ],
                 ],               
             ], [
                 'name'          => 'api_key',
                 'title'         => 'stripe::app.configuration.production-api-key',
                 'info'          => 'stripe::app.configuration.production-info',
                 'type'          => 'password',
                 'value'         =>  null,
                 'channel_based' =>  false,
                 'locale_based'  =>  false,
             ], [
                 'name'          => 'api_publishable_key',
                 'title'         => 'stripe::app.configuration.production-publishable-key',
                 'info'          => 'stripe::app.configuration.production-info',
                 'type'          => 'password',
                 'value'         =>  null,
                 'channel_based' =>  false,
                 'locale_based'  =>  false,
             ], [
                 'name'          => 'api_test_key',
                 'title'         => 'stripe::app.configuration.sandbox-api-key',
                 'info'          => 'stripe::app.configuration.sandbox-info',
                 'type'          => 'password',
                 'value'         =>  null,
                 'channel_based' => false,
                 'locale_based'  => false,
             ], [
                 'name'          => 'api_test_publishable_key',
                 'title'         => 'stripe::app.configuration.sandbox-api-publishable-key',
                 'info'          => 'stripe::app.configuration.sandbox-info',
                 'type'          => 'password',
                 'value'         =>  null,
                 'channel_based' => false,
                 'locale_based'  => false,
             ],
         ],
     ],
];