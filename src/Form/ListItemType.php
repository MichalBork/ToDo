<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ListItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('task', TextType::class, [
                'label' => 'What do you need to do today?',
                'attr' => [
                    'class' => 'form-control form-control-lg'
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Add',
                'attr' => [
                    'class' => 'btn btn-primary btn-lg ms-2'
                ],
            ]);
    }
}
