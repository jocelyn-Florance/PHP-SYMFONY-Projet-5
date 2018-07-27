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
     * @throws \ReflectionException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
           $_SESSION['erreur'] = [];

           $instanceForm = new FormContact();
           $form = $instanceForm->formContact();

        if (isset($_POST[$form->getName()])) {
            $form->submit($_POST[$form->getName()]);
            if ($form->isValid()) {

                 $data = new Contact($form->getData());
                 $nom = $data->nom();
                 $prenon = $data->prenon();
                 $email = $data->email();
                 $contenu = $data->message();

                 $instanceEmail = new Form();
                 $mailer = $instanceEmail->emailTransport();

                $message = (new \Swift_Message($email))
                    ->setFrom([$email => $nom . '-' . $prenon])
                    ->setTo(['jocelyn.florancepro@gmail.com' => 'Jocelyn'])
                    ->setBody($contenu);

                $mailer->send($message);
                $_SESSION['erreur'] = ['type' => 'alert-success', 'content' => 'Envoi du message en cour vous allez être redirigé'];
                header('Refresh: 3');

            }
        }

        echo $this->getTwig()->render('homepage.html.twig', [
            'session' => $_SESSION,
            'form' => $form->createView()
            ]);
    }

}