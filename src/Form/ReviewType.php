<?php

namespace App\Form;

use App\Entity\Review;
use App\Entity\Show;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Ton pseudo',
                'help' => 'Soit créatif',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Ton email',
            ])
            ->add('content', TextareaType::class, [
                'label' => "Ton message",
            ])
            ->add('rating', ChoiceType::class, [
                'label' => 'Avis',
                'choices'  => [
                    "Excellent" => 5,
                    "Très bon" => 4,
                    "Bon" => 3,
                    "Peut mieux faire" => 2,
                    "A éviter" => 1,
                ],
                "expanded" => false,
                "multiple" => false,
            ])
            ->add('reactions', ChoiceType::class, [
                'label' => 'Ce film vous a fait',
                'choices'  => Review::REACTIONS,
                "expanded" => true,
                "multiple" => true,
            ])
            ->add('watchedAt', DateType::class, [
                'label' => 'Tu as vu ce film le :',
                'widget' => 'single_text',
            ])
            // ->add('artWork', EntityType::class, [
            //     'class' => Show::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
