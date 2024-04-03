<?php

namespace App\Form;

use App\Entity\Etablissement;
use App\Entity\Lieu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtablissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomEtablissement')
            ->add('IDLieu', EntityType::class, [
                'class' => Lieu::class,
                //rajoute une valeur "aucun" dans la liste deroulante des lieux pour permettre de ne pas selectionner de lieu (id= NULL)
                'placeholder' => 'Aucun',
                //affiche la ville et le code postal
                'choice_label' => (function ($lieu) {
                    return $lieu->getVille() . ' - ' . $lieu->getCodePostal();
                }),
                'choice_value' => 'id',
            ])
            //ajoute le formulaire de creation d'un lieu si il n'apparait pas dans la liste deroulante des lieux
            ->add('NouveauLieu', LieuType::class, [
                'mapped' => false,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}
