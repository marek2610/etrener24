<?php

namespace App\Form;

use App\Entity\KategoriaWiekowa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KategoriaWiekowaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwaPzpn', TextType::class, [
                'label' => 'Nazwa PZPN'
            ])
            ->add('grupaWiekowa', TextType::class, [
                'label' => 'Grupa wiekowa'
            ])
            ->add('nazwaUefa', TextType::class, [
                'label' => 'Nazwa UEFA'
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
            'data_class' => KategoriaWiekowa::class,
        ]);
    }
}
