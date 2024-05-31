<?php
    return [
        'quotes' => [
            'send-invoice-btn'     => 'Send Invoice',
            'send-invoice-error'   => 'Some think is wrong!',
            'send-invoice-success' => 'Invoice successfully sent.',
            'sending'              => 'Sending..',
        ],

        'email' => [
            'index' => [
                'subject' => 'Payment Request',
                'dear'    => 'Dear :name',
                'info'    => 'You are receiving this email for payment please click Buy Now.',
                'buy-now' => 'Buy Now',
                'thanks'  => 'Thanks!',
            ],

            'success' => [ 
                'subject' => 'Quote #:id Completed',
                'dear'    => 'Dear :name',
                'view'    => 'Quote #:id',
                'info'    => 'Quote :id Payment successfully Completed.',
                'thanks'  => 'Thanks!',
            ],

            'cancel' => [
                'subject' => 'Quote #:id Cancelled',
                'dear'    => 'Dear :name',
                'info'    => 'Quote #:id Payment Cancelled.',
                'thanks'  => 'Thanks!',
            ],

            'quote' => [
                'subject' => 'Quote Invoice #:id',
                'dear'    => 'Dear :name',
                'view'    => 'Quote #:id',
                'info'    => 'Quote :id Payment Invoice attached.',
                'thanks'  => 'Thanks!',
            ],
        ],

        'success' => [
            'index' => [
                'success'    => 'Thanks for your order!',
                'return-btn' => 'Return to Quote #:id',
                'info'       => 'We appreciate your business! If you have any questions, please email support@solumesl.com.',
            ],
        ],

        'cancel' => [
            'index' => [ 
                'return-btn'   => 'Return to Quote #:id',
                'cancel'       => 'Checkout Cancelled',
                'already-paid' => 'Payment Already completed',
                'info'         => 'Forgot to add something to your cart? Shop around then come back to pay!',
            ],
        ],

        'configuration' => [
            'heading'                     => 'Stripe Payment Method',
            'title'                       => 'Title',
            'status'                      => 'Status',
            'description'                 => 'Description',
            'debug'                       => 'Debug',
            'production-api-key'          => 'Production API Secret Key',
            'production-publishable-key'  => 'Production Publishable key',
            'production-info'             => 'Applicable if production is selected',
            'sandbox-api-key'             => 'Sandbox API Secret Key',
            'sandbox-api-publishable-key' => 'Sandbox Publishable Key',
            'sandbox-info'                => 'Applicable if sandbox is selected',
            'currency-code'               => 'Currency Code',
            'expired_at'                  => 'Quote Expired message',
        ],
    ];
?>
