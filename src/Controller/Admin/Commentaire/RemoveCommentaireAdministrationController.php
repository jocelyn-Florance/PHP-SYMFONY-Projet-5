<?php

namespace App\Controller\Admin\Commentaire;

use App\Controller\Controller;
use App\Entity\Comment;
use App\Form\FormRemoveCommentaire;
use App\Repository\Admin\AdministrationRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class RemoveCommentaireAdministrationController
 * @package App\Controller\Admin
 */
class RemoveCommentaireAdministrationController extends Controller
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

            $instance = new FormRemoveCommentaire();
            $form = $instance->formRemoveCommentaire();

            if (isset($_POST[$form->getName()])) {
                $form->submit($_POST[$form->getName()]);
                if ($form->isValid()) {

                    $data = new Comment($form->getData());
                    $auteur = $data->auteur();

                    $instanceRepo = new AdministrationRepository();
                    $instanceRepo->RemoveCommentaire($auteur, $id);
                    header('Refresh: 3');
                }
            }

        }else{
            $response = new RedirectResponse('/404');
            return $response->send();
        }

        echo $this->getTwig()->render('Admin/Commentaire/removeCommentaireAdministration.html.twig', array(
            'session' => $_SESSION,
            'form' => $form->createView()
        ));
    }
}