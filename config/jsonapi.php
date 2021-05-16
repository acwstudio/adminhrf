<?php

return [
    'resources' => [
        'articles' => [
            'relationships' => [
                [
                    'type' => 'authors',
                    'method' => 'authors',
                ],
                [
                    'type' => 'tags',
                    'method' => 'tags',
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
        'tags' => [
            'relationships' => [
                [
                    'type' => 'articles',
                    'method' => 'articles',
                ]
            ]
        ],
    ]
];
