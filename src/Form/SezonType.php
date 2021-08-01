<?php

namespace App\Form;

use App\Entity\Sezon;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SezonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa')
            ->add('opis')
            ->add('team', EntityType::class, [
                'placeholder'   => 'Wybierz zespół',
                'class' =>  Team::class,
                'choice_label' => function(Team $team) {
                    return sprintf('%s / %s' , $team->getGrupaWiekowa(), $team->getNazwaShort(),
                );
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sezon::class,
        ]);
    }
}
