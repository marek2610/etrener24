<?php

namespace App\Form;

use App\Entity\Konspekt;
use App\Entity\Team;
use App\Entity\Treningi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TreningiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('data')
            ->add('druzyna', EntityType::class, [
                'class' => Team::class,
                // 'query_builder' => function (EntityRepository $er) {
                //     return $er->createQueryBuilder('k')
                //         ->orderBy('k.grupa', 'ASC');
                // },
                // 'choice_label' => 'grupa',

                // 'choice_label' => function(Krew $krew) {
                //     return sprintf('(%d) %s', $krew->getId(), $krew->getGrupa());
                // },
                'placeholder' => 'Wybierz drużynę'
            ])
            ->add('konspekt', EntityType::class, [
                'class' => Konspekt::class,
                'placeholder'   => 'Wybierz konspekt treningowy'
            ])
            ->add('data', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Treningi::class,
        ]);
    }
}
