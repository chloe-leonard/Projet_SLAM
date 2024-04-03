<?php

namespace App\Form;

use App\Entity\Etablissement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Pseudo')
            ->add('Bio')
            ->add('Avatar')
            ->add('mail')
            ->add('MotDePasse')
            //->add('nb_signalement')
            //affiche une liste deroulante contenant tous les etablissements disponibles dans la base de données, mais qui récuperera l'id de l'etablissement selectionné
 /*           ->add('id_etablissement', EntityType::class, [
                'class' => Etablissement::class,
                //rajoute une valeur "aucun" dans la liste deroulante des etablissements pour permettre de ne pas selectionner d'etablissement (id= NULL)
                'placeholder' => 'Aucun',
                'choice_label' => (function ($etablissement) {
                    return $etablissement->getNomEtablissement() . ' - '.  $etablissement->getIdLieu()->getVille();
                 }),

                'choice_value' => 'id',
            ])

*/
            //->add('dateCreation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
