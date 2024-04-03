<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Publication;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('Description')
            ->add('DateHeure')
            ->add('DureeRetard')
            ->add('IDUtilisateur', HiddenType::class, [
                'data' => $options['user_id'], // Récupérez l'ID de l'utilisateur,
            ])
            // Ajoutez le champ images pour sélectionner plusieurs images

            ->add('images', FileType::class, [
                'label' => 'Photo (JPG, PNG, GIF)',
                'mapped' => false,
                'required' => false,
                'multiple' => true, // Permettre à l'utilisateur de sélectionner plusieurs fichiers
            ])
            ->add('videos', FileType::class, [
                'label' => 'Video (MP4, AVI, MOV)',
                'mapped' => false,
                'required' => false,
                'multiple' => true, // Permettre à l'utilisateur de sélectionner plusieurs fichiers
            ])

            // Ajoutez le champ hashtags pour sélectionner plusieurs hashtags

            ->add('hashtags', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'required' => false,
                'attr' => ['class' => 'hashtags-collection'], // Ajoutez une classe pour le CSS et le JavaScript
                'label' => 'hashtags', // Étiquette du champ
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Publication::class,
            'user_id' => null, // Option pour stocker l'ID de l'utilisateur
            'allow_extra_fields' => false, // Set to false to prevent extra fields


        ]);
    }
}
