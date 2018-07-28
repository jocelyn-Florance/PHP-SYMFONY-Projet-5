<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\FormCommentaire;
use App\Repository\ArticleRepository;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends Controller
{

    /**
     * @param array $params
     * @throws \ReflectionException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(array $params)
    {
        $id = $params[0];
        $_SESSION['erreur'] = [];

        $instanceRepo = new ArticleRepository();

        $intsnaceForm = new FormCommentaire();
        $form = $intsnaceForm->formCommentaire($id);

        if (isset($_POST[$form->getName()])) {
            $form->submit($_POST[$form->getName()]);
            if ($form->isValid()) {

                $data = new Comment($form->getData());
                $id_article = $data->id_article();
                $auteur = $data->auteur();
                $contenu = $data->contenu();

                $instanceRepo->AddCommentaire($id_article, $auteur, $contenu, $id);
                 header('Refresh: 3');
            }
        }

        $article[] = $instanceRepo->ArticleShow($id);
        $comment = $instanceRepo->CommentShow($id);

        echo $this->getTwig()->render('article.html.twig', [
            'session' => $_SESSION,
            'form' => $form->createView(),
            'article' => $article,
            'comment' => $comment
        ]);
    }

}