<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Form\Form;
use App\Form\FormContact;

/**
 * Class HomepageController
 * @package App\Controller
 */
class HomepageController extends Controller
{

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
           unset($_SESSION['erreur']);

           $instance = new FormContact();
           $form = $instance->formContact();

        if (isset($_POST[$form->getName()])) {
            $form->submit($_POST[$form->getName()]);
            if ($form->isValid()) {

                 $data = new Contact($form->getData());
                 $nom = $data->nom();
                 $prenon = $data->prenon();
                 $email = $data->email();
                 $message = $data->message();

                $instanceEmail = new Form();
                $mailer = $instanceEmail->emailTransport();

                $message = (new \Swift_Message($email))
                    ->setFrom([$email => $nom . '-' . $prenon])
                    ->setTo(['jocelyn.florancepro@gmail.com' => 'Jocelyn'])
                    ->setBody($message)
                ;

                $mailer->send($message);
                $_SESSION['erreur'] = ['type' => 'alert-success', 'content' => 'Envoi du message en cour vous allez etre redirigé'];
                header('Refresh: 3');

            }
        }

        echo $this->getTwig()->render('homepage.html.twig', [
            'session' => $_SESSION,
            'form' => $form->createView(),
            ]);
    }

}