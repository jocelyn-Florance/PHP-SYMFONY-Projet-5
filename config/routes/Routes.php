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

    'Authentification' => [
        'path' => '/authentification',
        'method' => 'GET',
        'action' => \App\Controller\AuthentificationController::class,
        'params' => []
    ],

    'Authentification Post' => [
        'path' => '/authentification',
        'method' => 'POST',
        'action' => \App\Controller\AuthentificationController::class,
        'params' => []
    ],

    'Administration' => [
        'path' => '/administration/{token}',
        'method' => 'GET',
        'action' => \App\Controller\Admin\AdministrationController::class,
        'params' => [
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Post' => [
        'path' => '/administration/{token}',
        'method' => 'POST',
        'action' => \App\Controller\Admin\AdministrationController::class,
        'params' => [
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Article' => [
        'path' => '/administration/articles/{token}',
        'method' => 'GET',
        'action' => \App\Controller\Admin\Article\ArticleAdministrationController::class,
        'params' => [
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Commentaire' => [
        'path' => '/administration/commentaire/{token}',
        'method' => 'GET',
        'action' => \App\Controller\Admin\Commentaire\CommentaireAdministrationController::class,
        'params' => [
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Article Edit' => [
        'path' => '/administration/article-edit/{slug}/{token}',
        'method' => 'GET',
        'action' => \App\Controller\Admin\Article\EditArticleAdministrationController::class,
        'params' => [
            'slug' => '[0-9-]+',
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Article Edit Post' => [
        'path' => '/administration/article-edit/{slug}/{token}',
        'method' => 'POST',
        'action' => \App\Controller\Admin\Article\EditArticleAdministrationController::class,
        'params' => [
            'slug' => '[0-9-]+',
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Article Remove' => [
        'path' => '/administration/article-delete/{slug}/{token}',
        'method' => 'GET',
        'action' => \App\Controller\Admin\Article\RemoveArticleAdministrationController::class,
        'params' => [
            'slug' => '[0-9-]+',
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Article Remove Post' => [
        'path' => '/administration/article-delete/{slug}/{token}',
        'method' => 'POST',
        'action' => \App\Controller\Admin\Article\RemoveArticleAdministrationController::class,
        'params' => [
            'slug' => '[0-9-]+',
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Commentaire Edit' => [
        'path' => '/administration/commentaire-edit/{slug}/{token}',
        'method' => 'GET',
        'action' => \App\Controller\Admin\Commentaire\EditCommentaireAdministrationController::class,
        'params' => [
            'slug' => '[0-9-]+',
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Commentaire Edit Post' => [
        'path' => '/administration/commentaire-edit/{slug}/{token}',
        'method' => 'POST',
        'action' => \App\Controller\Admin\Commentaire\EditCommentaireAdministrationController::class,
        'params' => [
            'slug' => '[0-9-]+',
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Commentaire Remove' => [
        'path' => '/administration/commentaire-delete/{slug}/{token}',
        'method' => 'GET',
        'action' => \App\Controller\Admin\Commentaire\RemoveCommentaireAdministrationController::class,
        'params' => [
            'slug' => '[0-9-]+',
            'token' => '[a-zA-Z0-9-]+'
        ]
    ],

    'Administration Commentaire Remove Post' => [
        'path' => '/administration/commentaire-delete/{slug}/{token}',
        'method' => 'POST',
        'action' => \App\Controller\Admin\Commentaire\RemoveCommentaireAdministrationController::class,
        'params' => [
            'slug' => '[0-9-]+',
            'token' => '[a-zA-Z0-9-]+'
        ]
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
    ],

    'Article Slug Post' => [
        'path' => '/article/{slug}',
        'method' => 'POST',
        'action' => \App\Controller\ArticleController::class,
        'params' => [
            'slug' => '[0-9-]+'
        ]
    ],

    'Deconexion' => [
    'path' => '/deconexion',
    'method' => 'GET',
    'action' => \App\Controller\Admin\DeconexionController::class,
    'params' => []
     ],

    '404' => [
        'path' => '404',
        'method' => 'GET',
        'action' => \App\Controller\ErrorsController::class,
        'params' => []
    ],

];