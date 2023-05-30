<?php

namespace App\Form;

use App\Entity\Critere;
use App\Entity\Garage;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'constraints' => [new Length(min: 5, max: 255)],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'constraints' => [new Length(min: 5, max: 255)],
            ])
            ->add('lienImage', TextType::class, [
                'label' => 'Lien de l\'image',
                'constraints' => [new Length(min: 5, max: 255)],
            ])
            ->add('prixLocation', TextType::class, [
                'label' => 'Prix de la location',
            ])
            ->add('garage', EntityType::class, [
                'class' => Garage::class,
                'choice_label' => 'nomGarage',
            ])
            ->add('criteres', EntityType::class, [
                'class' => Critere::class,
                'choice_label' => 'valeur',
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
