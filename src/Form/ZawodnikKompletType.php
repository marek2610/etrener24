<?php

namespace App\Form;

use App\Entity\Krew;
use App\Entity\Zawodnik;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ZawodnikKompletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imie', TextType::class, [
                'label' => 'Imię',
            ])
            ->add('nazwisko', TextType::class, [
                'label' => 'Nazwisko',
            ])
            ->add('dataUrodzenia', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'label' => 'Data urodzenia',
            ])
            ->add('pesel')
            ->add('miejsceUrodzenia')
            ->add('adres')
            ->add('kodPocztowy')
            ->add('miejscowosc')
            ->add('poczta')
            ->add('email')
            ->add('telefon')
            ->add('noga', ChoiceType::class, [
                'placeholder' => 'Wybierz',
                'choices'   => [
                    'lewa'  => 'lewa',
                    'prawa' => 'prawa',
                    'lewa/prawa'    => 'lewa/prawa'
                ]
            ])
            ->add('szkola')
            ->add('wzrost')
            ->add('waga')
            ->add('pozycja')
            ->add('grupaKrwi', EntityType::class, [
                'class' => Krew::class,
                // 'query_builder' => function (EntityRepository $er) {
                //     return $er->createQueryBuilder('k')
                //         ->orderBy('k.grupa', 'ASC');
                // },
                // 'choice_label' => 'grupa',

                // 'choice_label' => function(Krew $krew) {
                //     return sprintf('(%d) %s', $krew->getId(), $krew->getGrupa());
                // },
                'placeholder' => 'Wybierz grupę krwi'
            ])
            ->add('pierwszyKlub')
            ->add('numerNaKoszulce')
            ->add('nrKartyZawodnika')
            ->add('dataWaznosciKarty', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'label' => 'Data ważności karty',
            ])
            ->add('dataRejestracjiWKlubie', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'label' => 'Data rejestracji w klubie',
            ])
            ->add('imieRodzica')
            ->add('naziwskoRodzica')
            ->add('emailRodzica')
            ->add('nrTelefonuRodzica')
            ->add('submit', SubmitType::class, [
                'label' => 'Modyfikuj',
                'attr'  => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->add('team', EntityType::class, [
                'class' => Team::class,
                'placeholder'   => 'Wybierz zespół',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Zawodnik::class,
        ]);
    }
}
