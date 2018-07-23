<?php
namespace App\Form;

use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Swift_SmtpTransport;


class Form
{
    public function formBuilder()
    {
        $csrfTokenManager = new CsrfTokenManager();
        $validator = Validation::createValidator();

        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new CsrfExtension($csrfTokenManager))
            ->addExtension(new ValidatorExtension($validator))
            ->getFormFactory();

        return $formFactory;
    }

    public function emailTransport()
    {
        $config = require __DIR__ . './../../config/swiftmailer/swiftmailer.php';
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername($config['Username'])
            ->setPassword($config['Password']);

         $mailer = new \Swift_Mailer($transport);
         return $mailer;
    }

}