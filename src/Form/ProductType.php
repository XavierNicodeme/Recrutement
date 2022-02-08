<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Nom'
                ],
            ])
            ->add('priceHt', IntegerType::class, [
                'label' => 'Prix hors taxe',
                'attr' => [
                    'placeholder' => 'Prix hors taxe'
                ],
            ])
        ;
    }
}