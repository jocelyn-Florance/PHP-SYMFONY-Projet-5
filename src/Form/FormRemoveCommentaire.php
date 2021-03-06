<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Length;

class FormRemoveCommentaire extends Form
{
    public function formRemoveCommentaire()
    {

        $formFactory = $this->formBuilder();
        $form = $formFactory->createBuilder()
            ->add('auteur', TextType::class, array(
                'help' => 'Merci de taper le non de l\'auteur pour le suprimer',
                'label'  => 'Auteur commentaire',
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
                        'minMessage' => 'Auteur dois comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Auteur ne peut pas dépasser les {{ limit }} caractères.'
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