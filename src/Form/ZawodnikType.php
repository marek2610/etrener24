<?php

namespace App\Form;

use App\Entity\Zawodnik;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZawodnikType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('imie', TextType::class, [
            'label' => 'Imię',
            'attr'  => [
                'placeholder' => 'Jan',
            ]
        ])
        ->add('nazwisko', TextType::class, [
            'label' => 'Nazwisko',
            'attr'  => [
                'placeholder' => 'Kowalski',
            ]
        ])
        ->add('dataUrodzenia', DateType::class, [
            'widget' => 'single_text',
            // this is actually the default format for single_text
            'format' => 'yyyy-MM-dd',
            'label' => 'Data urodzenia',
            'data'  => new \DateTime(),
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Dodaj',
            'attr'  => [
                'class' => 'btn btn-success'
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'    => Zawodnik::class
        ]);
    }
}
