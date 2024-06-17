<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Trip;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('coucou', ChoiceType::class, [
                'multiple' => false,
                'expanded' => true,
                'choices' => [
                    'Salut' => 'fr',
                    'Hello' => 'en',
                    'Hola' => 'es',
                ],
                'mapped' => false // car on ne veut pas 
                                    // que le composant formulaire 
                                    // enregistre cette donnée dans l'entité
            ])
            // ->add('trips', EntityType::class, [
            //     'class' => Trip::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
        ]);
    }
}
