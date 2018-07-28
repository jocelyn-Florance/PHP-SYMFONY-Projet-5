<?php

namespace App\Controller\Admin\Commentaire;

use App\Controller\Controller;
use App\Entity\Comment;
use App\Form\FormEditCommentaire;
use App\Repository\Admin\AdministrationRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class EditCommentaireAdministrationController
 * @package App\Controller\Admin
 */
class EditCommentaireAdministrationController extends Controller
{
    /**
     * @param array $params
     * @return mixed
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

            $instance = new FormEditCommentaire();
            $form = $instance->formEditCommentaire($id);

            if (isset($_POST[$form->getName()])) {
                $form->submit($_POST[$form->getName()]);
                if ($form->isValid()) {

                    $data = new  Comment($form->getData());
                    $auteur = $data->auteur();
                    $contenu = $data->contenu();
                    $valider = $data->valider();

                    $instanceRepo = new AdministrationRepository();
                    $instanceRepo->EditeCommentaire($auteur, $contenu, $valider, $id);
                    header('Refresh: 3');
                }
            }

        }else{
            $response = new RedirectResponse('/404');
            return $response->send();
        }

        echo $this->getTwig()->render('Admin/Commentaire/editCommentaireAdministration.html.twig', array(
            'session' => $_SESSION,
            'form' => $form->createView()
        ));
    }
}