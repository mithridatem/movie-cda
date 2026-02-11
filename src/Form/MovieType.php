<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Director;
use App\Entity\Movie;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Saisir le titre du film'
            ])
            ->add('synopsis', TextareaType::class, [
                'label' => 'Saisir le synopsis du film'
            ])
            ->add('cover', FileType::class, [
                'label' => 'ajouter une image',
                'required' => false
            ])
            ->add('createdAt', DateType::class, [
                'label'=> 'Saisir la date de sortie du film'
            ])
            ->add('categories', EntityType::class, [
                'label'=> 'sélectionner les categories',
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('directors', EntityType::class, [
                'label'=> 'choisir les réalisateurs',
                'class' => Director::class,
                'multiple' => true,
            ])
            ->add('save', SubmitType::class, [
                'label'=>'Ajouter'
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
