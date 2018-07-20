<?php

return [

    'Hommepage' => [
        'path' => '/',
        'method' => 'GET',
        'action' => \App\Controller\HomepageController::class,
        'params' => []
    ],

    'Article List' => [
        'path' => '/liste-article',
        'method' => 'GET',
        'action' => \App\Controller\ArticleListController::class,
        'params' => []
    ],

    'Article Slug' => [
        'path' => '/article/{slug}',
        'method' => 'GET',
        'action' => \App\Controller\ArticleController::class,
        'params' => [
            'slug' => '[0-9-]+'
        ]
    ]

];