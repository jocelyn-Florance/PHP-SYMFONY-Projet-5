<?php

namespace App\Controller\Admin\Commentaire;


use App\Controller\Controller;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CommentaireAdministrationController extends Controller
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
        $commentaire = $instance->ListeCommentaire();

        }else{
            $response = new RedirectResponse('/404');
            return $response->send();
        }

        echo $this->getTwig()->render('Admin/Commentaire/commentaireAdministration.html.twig', array(
            'session' => $_SESSION,
            'commentaire' => $commentaire
        ));
    }
}