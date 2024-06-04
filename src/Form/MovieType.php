<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('release_date', null, [
                'widget' => 'single_text',
            ])
            ->add('duration', null, [
                'widget' => 'single_text',
            ])
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'id',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('people', EntityType::class, [
                'class' => Person::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
