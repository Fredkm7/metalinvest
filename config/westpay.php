<?php

return [
    'merchant_slug'  => env('WESTPAY_MERCHANT_SLUG', ''),
    'webhook_secret' => env('WESTPAY_WEBHOOK_SECRET', ''),
    'country'        => env('WESTPAY_COUNTRY', 'Togo'),
    'min_amount'     => env('WESTPAY_MIN_AMOUNT', 3000),
    'max_amount'     => env('WESTPAY_MAX_AMOUNT', 500000),
];
