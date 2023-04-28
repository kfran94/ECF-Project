<?php

namespace App\Form;

use App\Entity\SeatMax;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaxSeatFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxSeat', null,[
                'label'=> 'Nombre de place maximum',
                'attr'=>['min'=> 1]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SeatMax::class,
        ]);
    }
}
