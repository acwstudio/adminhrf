<?php

return [
    'resources' => [
        'articles' => [
            'relationships' => [
                [
                    'type' => 'authors',
                    'method' => 'authors',
                ]
            ]
        ],
        'authors' => [
            'relationships' => [
                [
                    'type' => 'articles',
                    'method' => 'articles',
                ]
            ]
        ],
    ]
];
