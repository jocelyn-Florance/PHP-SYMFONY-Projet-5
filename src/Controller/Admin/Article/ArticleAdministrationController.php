<?php

namespace App\Controller\Admin\Article;

use App\Controller\Controller;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ArticleAdministrationController extends Controller
{
    /**
     * @param array $params
     * @return RedirectResponse
     * @throws \ReflectionException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(array $params)
    {

        $token = $params[0];

        if(isset($_SESSION['role']) == 'admin' && isset($token) == $_SESSION['token']) {

        $instance = new ArticleRepository();
        $article = $instance->ListeArticle();

        }else{
            $response = new RedirectResponse('/404');
            return $response->send();
        }

        echo $this->getTwig()->render('Admin/Article/articleAdministration.html.twig', array(
            'session' => $_SESSION,
            'article' => $article
        ));
    }
}