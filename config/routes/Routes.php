<?php

return [

    'Hommepage' => [
        'path' => '/',
        'method' => 'GET',
        'action' => \App\Controller\HomepageController::class,
        'params' => []
    ],

    'Hommepage Post' => [
        'path' => '/',
        'method' => 'POST',
        'action' => \App\Controller\HomepageController::class,
        'params' => []
    ],

    'Article List' => [
        'path' => '/liste-articles',
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