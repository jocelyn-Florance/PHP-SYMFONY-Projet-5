<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class FormAuthentification
 * @package App\Form
 */
class FormAuthentification extends Form
{
    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function formAuthentification()
    {
        $formFactory = $this->formBuilder();

        $form = $formFactory->createBuilder()
            ->add('Email', EmailType::class, array(
                'constraints' => new Email(array(
                    'message' => 'L\'email {{ value }} n\'est pas un email valide.'
                ))
            ))
            ->add('Password', PasswordType::class, array(
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Cette valeur ne doit pas être vide.'
                    )),
                    new Length(array(
                        'min' => 5,
                        'max' => 30,
                        'minMessage' => 'Votre password dois comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre password ne peut pas dépasser les {{ limit }} caractères.'
                    ))
                )
            ))
            ->add('Envoyer', SubmitType::class)
            ->getForm();

        return $form;
    }

}