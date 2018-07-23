<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * Class FormContact
 * @package App\Form
 */
class FormContact extends Form
{
    public function formContact()
    {

       $formFactory = $this->formBuilder();

        $form = $formFactory->createBuilder()
            ->add('Nom', TextType::class, array(

                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Cette valeur ne doit pas être vide.'
                    )),
                    new Type(array(
                        'type' => 'string',
                        'message' => 'La valeur {{ value }} n\'est pas un {{ type }} valide.'
                    )),
                    new Length(array(
                        'min' => 2,
                        'max' => 20,
                        'minMessage' => 'Votre nom dois comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre nom ne peut pas dépasser les {{ limit }} caractères.'
                    ))
                )
            ))
            ->add('Prenon', TextType::class, array(
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Cette valeur ne doit pas être vide.'
                    )),
                    new Type(array(
                        'type' => 'string',
                        'message' => 'La valeur {{ value }} n\'est pas un {{ type }} valide.'
                    )),
                    new Length(array(
                        'min' => 2,
                        'max' => 20,
                        'minMessage' => 'Votre prénon dois comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre prénom ne peut pas dépasser les {{ limit }} caractères.'
                    ))
                )
            ))
            ->add('Email', EmailType::class, array(
                'constraints' => new Email(array(
                    'message' => 'L\'email {{ value }} n\'est pas un email valide.'
                ))
            ))
            ->add('Message', TextareaType::class, array(
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Cette valeur ne doit pas être vide.'
                    )),
                    new Length(array(
                        'min' => 1,
                        'max' => 200,
                        'minMessage' => 'Votre message dois comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre message ne peut pas dépasser les {{ limit }} caractères.'
                    ))
                )
            ))
            ->add('Envoyer', SubmitType::class)
            ->getForm();

        return $form;
    }


}