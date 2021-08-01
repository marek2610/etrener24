<?php

namespace App\Form;

use App\Entity\Mecze;
use App\Entity\Przeciwnik;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeczeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('data', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('wynikHome')
            ->add('wynikAway')
            ->add('przeciwnik', EntityType::class, [
                'class' => Przeciwnik::class,
                'choice_label' => 
                function(Przeciwnik $przeciwnik) {
                    return sprintf('%s' , $przeciwnik->getNazwa(),);
                },
                'placeholder' => ''
            ])
            ->add('miejsce', ChoiceType::class, [
                'placeholder' => '',
                'choices'   => [
                    'dom'  => 'Dom',
                    'wyjazd' => 'Wyjazd'
                ]
            ])
            ;
    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mecze::class,
        ]);
    }
}
