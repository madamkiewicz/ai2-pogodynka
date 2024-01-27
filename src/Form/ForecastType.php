<?php

namespace App\Form;

use App\Entity\Forecast;
use Decimal\Decimal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Type;


class ForecastType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class)
            ->add('temperature', IntegerType::class)
            ->add('pressure', IntegerType::class)
            ->add('humidity', PercentType::class)
            ->add('windSpeed', NumberType::class) 
            ->add('windDirection', ChoiceType::class, [
                'choices' => [
                    'N' => 'N',
                    'E' => 'E',
                    'S' => 'S',
                    'W' => 'W',
                    'NE' => 'NE',
                    'SE' => 'SE',
                    'NW' => 'NW',
                    'SW' => 'SW',
                ],
            ])
            ->add('cloudiness', PercentType::class)
            ->add('icon')
            ->add('precipilation', TextType::class)
            ->add('location', EntityType::class, [
            'class' => 'App\Entity\Location',
            'choice_label' => 'city',
            ])
            ->setRequired(false);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Forecast::class,
        ]);
    }
}
