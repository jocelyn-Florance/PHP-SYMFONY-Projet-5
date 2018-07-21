<?php

namespace App\Controller;

/**
 * Class ArticleListController
 * @package App\Controller
 */
class ArticleListController extends Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        echo $this->getTwig()->render('article_list.html.twig', [
        ]);
    }

}