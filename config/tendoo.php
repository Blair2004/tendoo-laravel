<?php
return [
    'sign-in'       => [
        'allow-registration'    =>  true
    ],

    /**
     * System Language
    **/

    'system'        =>  [
        'language'  =>  [
            'en_US'     =>  'English US'
        ]
    ],

    'db'            =>  [
        'prefix'    =>  'tendoo_',
        'hostname'  =>  'localhost',
        'username'  =>  'root',
        'dbname'    =>  'tendoo'
    ],

    'debug'         =>  [
        'errors'    =>  false
    ],

    'roles'         =>  [
        'subscriber'    =>  1,
        'admin'         =>  2,
        'master'        =>  3
    ],

    /**
     * Save Setup Route Names
    **/

    'routes'    =>  [
        'setup'      =>  [
            'setup.index', 'setup.step', 'setup.db', 'setup.app'
        ]
    ],

    /**
     * Errors
    **/

    'errors'    =>   [
        '404'   =>  [
            'title'     =>  'Page Not Found',
            'message'   =>  'You went to far away from what we can treat.'
        ],
        'setup-locked'  =>  [
            'title'     =>  'Setup Locked',
            'message'   =>  'You can\'t access to that page, the setup is locked.'
        ],
        'token-error'   =>  [
            'title'     =>  'Token Error',
            'message'   =>  'Your request can\'t be treated. Your token has expired or is missing'
        ],
        'db-error'      =>  [
            'title'     =>  'Database Error',
            'message'   =>  'Check you request and try again.'
        ]
    ]
];