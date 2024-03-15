<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Publication;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commentaire')
            ->add('IDUtilisateur', HiddenType::class, [
                'data' => $options['user_id'], // Récupérez l'ID de l'utilisateur,
            ])
            ->add('IDPublication', HiddenType::class, [
                'data' => $options['publication_id'], // Récupérez l'ID de la publication,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
            'user_id' => null, // Option pour stocker l'ID de l'utilisateur
            'publication_id' => null, // Option pour stocker l'ID de la publication
        ]);
    }
}
