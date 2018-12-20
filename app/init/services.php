<?php
return [
    'services' => [
        'AclService' => [
            'class' => 'application\\services\\AclService',
            'path' => 'config/acl',
        ]
        ,
        'ConfigService' => [
            'class' => 'application\\services\\ConfigService',
            'path' => 'config',
        ]
    ]
];