<?php
/**
 * Build a configuration array to pass to `Hybridauth\Hybridauth`
 */

$config = [
    /**
     * Set the Authorization callback URL to https://path/to/hybridauth/examples/example_06/callback.php.
     * Understandably, you need to replace 'path/to/hybridauth' with the real path to this script.
     */
    'callback' => 'https://listing-app.com/admin/scripts/callback.php',
    'providers' => [
        // 'Twitter' => [
        //     'enabled' => true,
        //     'keys' => [
        //         'key' => '...',
        //         'secret' => '...',
        //     ],
        // ],
        'LinkedIn' => [
            'enabled' => true,
            'keys' => [
                'id' => '77z97uhzqdv0v5',
                'secret' => 'IW5RvYdy98l6CxcC',
            ],
            'scope' => 'r_liteprofile r_emailaddress',
        ],
        'Facebook' => [
            "photo_size" => 200, // optional
            'enabled' => true,
            'keys' => [
                'id' => '1138439479936262',
                'secret' => '03dd853f11f1c5a3c28151464523a004',
            ],
            'scope' => 'email, public_profile',
        ],
        'MicrosoftGraph' =>[
            'enabled' => true,
            'keys' => [
                // 790373ec-cba8-431b-92a9-b449af1ba2ff
                'id' => 'aba23751-41ab-47b9-9ac1-24d4f6fea513',
                'secret' => 'b4rr28HI.vFZeh~3953gn.Qe_95NpkRhQO',
            ],
            // 'scope' => 'openid, email, profile',
            
        ],
    ],
];