<?php

namespace App\Form;

use App\Entity\Cars;
use App\Entity\Modele;
use App\Entity\Carburant;
use App\Entity\TypeDeBoite;
use App\Entity\Transmission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddcarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('kilometrage',IntegerType::class,[
                'attr' => ['class' => 'form-control ']
            ])
            ->add('price',IntegerType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('nbproprio',IntegerType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('cylindree',IntegerType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('puissancech',IntegerType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('puissancekw',IntegerType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('year')
            ->add('description',TextareaType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('cover',TextType::class,[
                'attr' => ['class' => 'form-control','placeholder' => 'Url']
            ])
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
            ->add('Image', TextType::class,[
                'mapped' => false,
                'attr' => ['class' => 'form-control','placeholder' => 'Url']
            ])
            ->add('IdTypeDeBoite',EntityType::class,[
                'class'=>TypeDeBoite::class,
                'attr' => ['class' => 'form-control']
            ]);
            // ->add('Equipements',EntityType::class,[
            //     'class'=>Equipement::class,
            //     'mapped' => false,
            //     'attr' => ['class' => 'form-control','liste'],
            //     'choice_label' => 'name',
            //     'multiple' => true,
            //     'expanded' => true
            // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
