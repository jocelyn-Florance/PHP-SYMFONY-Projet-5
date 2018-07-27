<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Length;

class FormRemoveArticle extends Form
{
    public function formRemoveArticle()
    {

        $formFactory = $this->formBuilder();
        $form = $formFactory->createBuilder()
            ->add('titre', TextType::class, array(
                'help' => 'Merci de taper le non de l\'article pour le suprimer',
                'label'  => 'Titre Article',
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
                        'minMessage' => 'Votre titre dois comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre titre ne peut pas dépasser les {{ limit }} caractères.'
                    ))
                )
            ))
            ->add('Suprimer', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-danger')
            ))
            ->getForm();

        return $form;
    }

}