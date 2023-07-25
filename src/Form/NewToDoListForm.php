<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewToDoListForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('list_name', TextType::class, [
                'label' => 'List name',
                'attr' => [
                    'placeholder' => 'Enter list name',
                    "class" => "form-control form-control-lg"
                ]
            ])
            ->add('add', SubmitType::class, [
                'attr' => [
                    "class" => "btn btn-primary btn-lg ms-2"
                ]
            ]);
    }

}