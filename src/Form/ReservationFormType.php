<?php

namespace App\Form;

use App\Entity\ReservationLink;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $availableTimes = $options['available_times'];
        $available_seats = $options['available_seats'];
        $defaultName = $options['default_name'];
        $defaultAllergies = $options['default_allergies'];


        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :',
                'data' => $defaultName
            ])
            ->add('time', ChoiceType::class, [
                'label' => 'Heure :',
                'choices' => $availableTimes,

            ])
            ->add('number_of_seats', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class, [
                'label' => 'Nombre de convives :',
                'attr' => [
                    'min' => 0,
                    'max' => $available_seats,
                ],
            ])
            ->add('allergies', TextType::class, [
                'label' => 'Mentionnez nous vos allergies pour notre chef',
                'required' => false,
                'data' => $defaultAllergies
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationLink::class,
            'available_times' => null,
            'available_seats' => null,
            'default_name' => null,
            'default_allergies' => null,
        ]);
    }

}
