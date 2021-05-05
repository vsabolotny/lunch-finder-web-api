<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fromTime', TimeType::class, [
                'minutes' => [0, 15, 30, 45],
                'hours' => [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
            ])
            ->add('toTime', TimeType::class, [
                'minutes' => [0, 15, 30, 45],
                'hours' => [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
            ])
            ->add('location')
            ->add('day')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
