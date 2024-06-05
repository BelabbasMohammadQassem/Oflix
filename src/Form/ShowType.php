<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Genre;
use App\Entity\Show;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Titre",
                "empty_data" => "",
            ])
            ->add('releasedAt', DateType::class, [
                'label' => "Date de sortie",
                'widget' => 'single_text',
            ])
            ->add('poster', UrlType::class, [
                'label' => "Image",
                'help' => "Url vers l'affiche"
            ])
            ->add('duration', IntegerType::class,[
                'label' => "Durée"
            ])
            ->add('summary', TextareaType::class, [
                'label' => "Résumé"
            ])
            ->add('synopsis', TextareaType::class, [
                'label' => "Synopsis"
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('countries', EntityType::class, [
                'label' => "Synopsis",
                'class' => Country::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Show::class,
        ]);
    }
}
