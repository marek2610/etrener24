<?php

namespace App\Form;

use App\Entity\Konspekt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KonspektType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa')
            ->add('temat')
            ->add('czasZajec', NumberType::class)
            ->add('pilki', NumberType::class)
            ->add('bramki', NumberType::class)
            ->add('oznaczniki', NumberType::class)
            ->add('stozki', NumberType::class)
            ->add('pacholki', NumberType::class)
            ->add('tyczki', NumberType::class)
            ->add('drabinki', NumberType::class)
            ->add('inne')
            ->add('opis')
            ->add('opisZajec', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Konspekt::class,
        ]);
    }
}
