<?php

namespace App\Form;

use App\Entity\OpeningHours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpeningHoursFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('opening_hours_morning', null, [
                'label' => 'Heures d\'ouverture (matin)',
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime',
                'model_timezone' => 'Europe/Paris',
            ])
            ->add('closing_hours_morning', null, [
                'label' => 'Heures de fermeture (matin)',
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime',
                'model_timezone' => 'Europe/Paris',
            ])
            ->add('opening_hours_evening', null, [
                'label' => 'Heures d\'ouverture (soir)',
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime',
                'model_timezone' => 'Europe/Paris',
            ])
            ->add('closing_hours_evening', null, [
                'label' => 'Heures de fermeture (soir)',
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime',
                'model_timezone' => 'Europe/Paris',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OpeningHours::class,
        ]);
    }
}
