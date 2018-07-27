<?php

namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormCommentaire extends Form
{
    public function formCommentaire($id)
    {
        $formFactory = $this->formBuilder();
        $form = $formFactory->createBuilder()
            ->add('auteur', TextType::class, array(
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
                        'max' => 30,
                        'minMessage' => 'Auteur dois comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Auteur ne peut pas dépasser les {{ limit }} caractères.'
                    ))
                )
            ))
            ->add('contenu', TextareaType::class, array(
                'attr' => array('rows' => '4'),
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Cette valeur ne doit pas être vide.'
                    )),
                    new Type(array(
                        'type' => 'string',
                        'message' => 'La valeur {{ value }} n\'est pas un {{ type }} valide.'
                    )),
                    new Length(array(
                        'min' => 10,
                        'max' => 400,
                        'minMessage' => 'Votre contenu dois comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre contenu ne peut pas dépasser les {{ limit }} caractères.'
                    ))
                )
            ))
            ->add('id_article', HiddenType::class, array(
                'data' => $id
            ))
            ->add('Envoyer', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success')
            ))
            ->getForm();

        return $form;
    }
}