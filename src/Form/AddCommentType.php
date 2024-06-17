<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Trip;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rating', ChoiceType::class, [
                'label' => "Ma note",
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    "⭐" => 1,
                    "⭐⭐" => 2,
                    "⭐⭐⭐" => 3,
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => "Mon commentaire"
            ])
            ->add('user', EntityType::class, [
                'label' => 'Je suis',
                'class' => User::class,
                'choice_label' => 'userName',
                'attr' => ['class' => 'form_user'],
            ])
            // ->add('trip', EntityType::class, [
            //     'class' => Trip::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
