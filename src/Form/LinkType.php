<?php

namespace App\Form;

use App\Entity\Link;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('originalUrl', TextType::class)
            ->add('shortCode', TextType::class, [
                'required' => false,
            ])
            ->add('expires_in', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    '1 minute' => 60,
                    '1 hour' => 3600,
                    '1 day' => 3600*24,
                    '1 week' => 3600*24*7
                ],
                'mapped' => false,
                'data' => 60,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Link::class,
        ]);
    }
}