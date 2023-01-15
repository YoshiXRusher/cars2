<?php

namespace App\Form;

use App\Entity\Cars;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
            ->add('IdCarbu')
            ->add('IdCarbu')
            ->add('IdTransmi')
            // ->add('images')
            ->add('IdTypeDeBoite')
            ->add('Equipements')  
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
