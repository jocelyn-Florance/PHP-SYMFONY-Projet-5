<?php
namespace App\Controller\Admin;

use App\Controller\Controller;
use App\Entity\Article;
use App\Form\FormArticle;
use App\Repository\Admin\AdministrationRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class AdministrationController
 * @package App\Controller\Admin
 */
class AdministrationController extends Controller
{
    /**
     * @param $params
     * @return RedirectResponse
     * @throws \ReflectionException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index($params)
    {
        $token = $params[0];
        $_SESSION['erreur'] = [];

        if(isset($_SESSION['role']) == 'admin' && isset($token) == $_SESSION['token']) {

            $instance = new FormArticle();
            $form = $instance->formArticle();

            $instanceRepo = new AdministrationRepository();
            $countComment = $instanceRepo->countComment();

            if (isset($_POST[$form->getName()])) {
                $form->submit($_POST[$form->getName()]);
                if ($form->isValid()) {

                    $data = new Article($form->getData());
                    $titre = $data->titre();
                    $chapo = $data->chapo();
                    $auteur = $data->auteur();
                    $contenu = $data->contenu();

                     $instanceRepo->addArticle($titre, $chapo, $auteur, $contenu);

                     $_SESSION['erreur'] = ['type' => 'alert-success', 'content' => 'Article ajouter'];
                     header('Refresh: 3');

                }
            }

        }else{
            $response = new RedirectResponse('/404');
            return $response->send();
        }

        echo $this->getTwig()->render('Admin/administration.html.twig', array(
            'session' => $_SESSION,
            'form' => $form->createView(),
            'commentaire' => $countComment
        ));
    }

}