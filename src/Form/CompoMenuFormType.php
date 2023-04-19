<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\Dish;
use App\Entity\MenuLinkDish;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompoMenuFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('menu_id', EntityType::class, [
                'class' => Menu::class,
                'choice_label' => 'title',
                'choice_value'=> 'id',
                'label' => 'title'
            ])
            ->add('dish_id', EntityType::class, [
                'class' => Dish::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'label' => 'Dish'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MenuLinkDish::class,
        ]);
    }
}
