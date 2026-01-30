<?php
return [
    'pagination_limit' => 10,
    'statuses' => [
        'ACTIVE' => [
            'value' => 1,
            'caption' => 'Active',
            'key' => 'ACTIVE',
        ],

        'INACTIVE' => [
            'value' => 0,
            'caption' => 'Inactive',
            'key' => 'INACTIVE',
        ],
    ],
    'roles' => [
        'ADMIN' => [
            'value' => 1,
            'caption' => 'Admin',
            'key' => 'ADMIN'
        ],
        'VENDOR' => [
            'value' => 2,
            'caption' => 'Agent',
            'key' => 'AGENT'
        ],
    ],
]
?>