<?php
namespace App\Controller;

use App\Entity\Authentification;
use App\Form\FormAuthentification;
use App\Repository\AuthentificationRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class AuthentificationController
 * @package App\Controller
 */
class AuthentificationController extends Controller
{
    /**
     * @return RedirectResponse
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
                $user = $instanceRepo->getLogin($email, $password);

                if($user == true) {

                    $token = random_bytes(15);
                    $token = bin2hex($token);

                    $_SESSION['token'] = $token;
                    $_SESSION['email'] = $user->email();
                    $_SESSION['prenon'] = $user->prenon();
                    $_SESSION['role'] = $user->role();

                    $response = new RedirectResponse('/administration/'. $token);
                    return $response->send();

                } else {
                    $_SESSION['erreur'] = ['type' => 'alert-danger', 'content' => 'Utilisateur n\'existe pas'];
                }

           } else {
                $_SESSION['erreur'] = ['type' => 'alert-danger', 'content' => 'Les champs ne sont pas valide'];
            }
        }

        echo $this->getTwig()->render('authentification.html.twig',array(
            'session' => $_SESSION,
            'form' => $form->createView()
        ));
    }
}