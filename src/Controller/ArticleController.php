<?php

namespace App\Controller;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends Controller
{

    /**
     * @param $params
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index($params)
    {

        $id = $params[0];

        echo $this->getTwig()->render('article.html.twig', [
            'id' => $id
        ]);
    }

}