<?php

namespace App\Controller;

use App\Repository\ArticleListRepository;


/**
 * Class ArticleListController
 * @package App\Controller
 */
class ArticleListController extends Controller
{
    /**
     * @throws \ReflectionException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {

        $instanceRepo = new ArticleListRepository();
        $getArticle = $instanceRepo->listArticle();

        echo $this->getTwig()->render('article_list.html.twig', [
            'session' => $_SESSION,
            'article' => $getArticle
        ]);
    }

}