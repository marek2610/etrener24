<?php

namespace App\Form;

use App\Entity\KategoriaWiekowa;
use App\Entity\Team;
use App\Entity\Trenerzy;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa')
            ->add('nazwaShort')
            ->add('opis')
            ->add('trener', EntityType::class,[
                'placeholder'   => 'Wybierz trenera',
                'class' => Trenerzy::class,
            ])
            ->add('grupaWiekowa', EntityType::class, [
                'placeholder'   => 'Wybierz grupę wiekową',
                'class' =>  KategoriaWiekowa::class,
                'choice_label' => function(KategoriaWiekowa $grupa) {
                    return sprintf('%s / %s / %s' , $grupa->getNazwaPzpn(), $grupa->getNazwaUefa(), 
                    $grupa->getGrupaWiekowa(),
                );
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
