<?php

namespace App\Form;

use App\Entity\Carburant;
use App\Entity\Cars;
use App\Entity\Equipement;
use App\Entity\Modele;
use App\Entity\Transmission;
use App\Entity\TypeDeBoite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddcarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('kilometrage')
            ->add('price')
            ->add('nbproprio')
            ->add('cylindree')
            ->add('puissancech')
            ->add('puissancekw')
            ->add('year')
            ->add('description')
            ->add('cover')
            ->add('IdModele',EntityType::class,[
                'class'=>Modele::class,
                'attr' => ['class' => 'form-control']
            ])
            ->add('IdCarbu',EntityType::class,[
                'class'=>Carburant::class,
                'attr' => ['class' => 'form-control']
            ])
            ->add('IdTransmi',EntityType::class,[
                'class'=>Transmission::class,
                'attr' => ['class' => 'form-control']
            ])
            // ->add('images')
            ->add('IdTypeDeBoite',EntityType::class,[
                'class'=>TypeDeBoite::class,
                'attr' => ['class' => 'form-control']
            ])
            // ->add('Equipements',EntityType::class,[
            //     'class'=>Equipement::class,
            //     'attr' => ['class' => 'form-control']
            // ])  
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
