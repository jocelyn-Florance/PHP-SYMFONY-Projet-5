<?php

namespace App\Controller;

use App\Repository\ArticleRepository;

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
    public function index(array $params)
    {
        $id = $params[0];

        $instance = new ArticleRepository();
        $article[] = $instance->ArticleShow($id);
        $comment = $instance->CommentShow($id);

        echo $this->getTwig()->render('article.html.twig', [
            'article' => $article,
            'comment' => $comment

        ]);
    }

}