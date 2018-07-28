<?php

namespace App\Form;

use App\Repository\Admin\AdministrationRepository;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class FormEditCommentaire extends Form
{
    public function formEditCommentaire($id)
    {

        $instance = new AdministrationRepository();
        $commentaire = $instance->CommentShow($id);

        $auteur = $commentaire->auteur();
        $contenu = $commentaire->contenu();

        $formFactory = $this->formBuilder();
        $form = $formFactory->createBuilder()
            ->add('auteur', TextType::class, array(
                'data' => $auteur,
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
                        'max' => 50,
                        'minMessage' => 'Auteur dois comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Auteur ne peut pas dépasser les {{ limit }} caractères.'
                    ))
                )
            ))
            ->add('contenu', TextareaType::class, array(
                'attr' => array('rows' => '5'),
                'help' => 'Maximun 300 caractere',
                'data' => $contenu,
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
                        'max' => 300,
                        'minMessage' => 'Votre contenu dois comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre contenu ne peut pas dépasser les {{ limit }} caractères.'
                    ))
                )
            ))
            ->add('valider', CheckboxType::class, array(
                'required' => false
            ))
            ->add('Envoyer', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success')
            ))
            ->getForm();

        return $form;
    }
}