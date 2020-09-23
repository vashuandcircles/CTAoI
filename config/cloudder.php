<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary API configuration
    |--------------------------------------------------------------------------
    |
    | Before using Cloudinary you need to register and get some detail
    | to fill in below, please visit cloudinary.com.
    |
    */

    'cloudName'  => env('CLOUDINARY_CLOUD_NAME'),
    'baseUrl'    => 'http://res.cloudinary.com/vashu',
    'secureUrl'  => 'https://res.cloudinary.com/vashu',
    'apiBaseUrl' => 'https://api.cloudinary.com/v1_1/vashu',
    'apiKey'     => '834731939163338',
    'apiSecret'  => 'X8FIVXYqEc2I4-ZU50bfGGUtWeI',

    'scaling'    => [
        'format' => 'png',
        'width'  => 150,
        'height' => 150,
        'crop'   => 'fit',
        'effect' => null
    ],

];
