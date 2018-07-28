<?php

namespace App\Controller\Admin\Article;

use App\Controller\Controller;
use App\Entity\Article;
use App\Form\FormEditArticle;
use App\Repository\Admin\AdministrationRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class EditArticleAdministrationController
 * @package App\Controller\Admin
 */
class EditArticleAdministrationController extends Controller
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

        $id = $params[0];
        $token = $params[1];

        $_SESSION['erreur'] = [];

        if(isset($_SESSION['role']) == 'admin' && isset($token) == $_SESSION['token']) {

        $instance = new FormEditArticle();
        $form = $instance->formEditArticle($id);

        if (isset($_POST[$form->getName()])) {
            $form->submit($_POST[$form->getName()]);
            if ($form->isValid()) {

                $data = new Article($form->getData());
                $titre = $data->titre();
                $chapo = $data->chapo();
                $contenu = $data->contenu();
                $auteur = $data->auteur();

                $instanceRepo = new AdministrationRepository();
                $instanceRepo->EditeArticle($titre, $chapo, $contenu, $auteur, $id);
                header('Refresh: 3');
            }
        }

        }else{
            $response = new RedirectResponse('/404');
            return $response->send();
        }

        echo $this->getTwig()->render('Admin/Article/editArticleAdministration.html.twig', array(
            'session' => $_SESSION,
            'form' => $form->createView()
        ));
    }
}