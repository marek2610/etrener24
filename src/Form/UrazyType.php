<?php

namespace App\Form;

use App\Entity\Urazy;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UrazyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rozpoznanie', TextType::class, [
                'label' => 'Rozpoznanie',
            ])
            ->add('zalecenia', TextType::class, [
                'label' => 'Zalecenia',
            ])
            ->add('rehabilitacja', TextType::class, [
                'label' => 'Rehabilitacja',
            ])
            ->add('dataKontuzji', DateType ::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'label' => 'Data kontuzji',
                'data'  => new \DateTime(),
            ])
            ->add('uwagi', TextType::class, [
                'label' => 'Uwagi',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Dodaj kontuzję',
                'attr'  => [
                    'class' => 'btn btn-success'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'    => Urazy::class
        ]);
    }
}
