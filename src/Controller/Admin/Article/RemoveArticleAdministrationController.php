<?php

namespace App\Controller\Admin\Article;

use App\Controller\Controller;
use App\Entity\Article;
use App\Form\FormRemoveArticle;
use App\Repository\Admin\AdministrationRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class RemoveArticleAdministrationController
 * @package App\Controller\Admin
 */
class RemoveArticleAdministrationController extends Controller
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

        $instance = new FormRemoveArticle();
        $form = $instance->formRemoveArticle();

        if (isset($_POST[$form->getName()])) {
            $form->submit($_POST[$form->getName()]);
            if ($form->isValid()) {

                $data = new Article($form->getData());
                $titre = $data->titre();


                $instanceRepo = new AdministrationRepository();
                $errors =  $instanceRepo->RemoveArticle($titre, $id);

                if($errors === 0){
                    $_SESSION['erreur'] = ['type' => 'alert-danger', 'content' => 'Le titre et pas bon'];
                }elseif ($errors === 1){
                    $_SESSION['erreur'] = ['type' => 'alert-success', 'content' => 'Article suprimer'];
                    header('Refresh: 3');
                }

            }
        }

        }else{
            $response = new RedirectResponse('/404');
            return $response->send();
        }

        echo $this->getTwig()->render('Admin/Article/removeArticleAdministration.html.twig', array(
            'session' => $_SESSION,
            'form' => $form->createView()
        ));
    }
}