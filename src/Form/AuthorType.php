<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('name')
            ->add('email')
            ->add('nbrBooks')
            ->add('address')
            ->add('library', ChoiceType::class, [
                'label' => 'Library',
                // Vous allez remplir les choix d'auteurs dynamiquement dans le contrôleur
                'choices' => [], // À mettre à jour dans le contrôleur
                'placeholder' => 'Select a library',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
