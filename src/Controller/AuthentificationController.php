<?php
namespace App\Controller;

use App\Entity\Authentification;
use App\Form\FormAuthentification;
use App\Repository\AuthentificationRepository;


/**
 * Class AuthentificationController
 * @package App\Controller
 */
class AuthentificationController extends Controller
{
    /**
     * @throws \ReflectionException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        $_SESSION['erreur'] = [];

        $instance = new FormAuthentification();
        $form = $instance->formAuthentification();

        if (isset($_POST[$form->getName()])) {
            $form->submit($_POST[$form->getName()]);
            if ($form->isValid()) {

                $data = new Authentification($form->getData());
                $email = $data->email();
                $password = $data->password();

                $instanceRepo = new AuthentificationRepository();
                $instanceRepo->getLogin($email, $password);

            }
        }

        echo $this->getTwig()->render('authentification.html.twig',array(
            'session' => $_SESSION,
            'form' => $form->createView()
        ));
    }
}