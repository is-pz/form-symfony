<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,[
                'label' => 'Titulo de la publicación',
                'help' => 'Piensa en el SEO ¿Cómo buscarías en Google?'         
            ])
            ->add('body', TextareaType::class,[
                'label' => 'Contenido',
                'attr' => ['rows' => 9, 'class'=>'bg-light']
            ])
            ->add('Enviar', SubmitType::class, [
                'attr' => ['class' => 'btn-dark']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            // 'csrf_protection' => false
            // 'csrf_field_name' => ''
        ]);
    }
}
