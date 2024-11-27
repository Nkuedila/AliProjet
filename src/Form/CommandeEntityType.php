<?php

namespace App\Form;

use App\Entity\CommandeEntity;
use App\Entity\PlatEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity')
            ->add('total')
            ->add('dateCommande', null, [
                'widget' => 'single_text',
            ])
            ->add('etat')
            ->add('nomClient')
            ->add('telephoneClient')
            ->add('emailClient')
            ->add('adresseClient')
            ->add('idplat', EntityType::class, [
                'class' => PlatEntity::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CommandeEntity::class,
        ]);
    }
}
