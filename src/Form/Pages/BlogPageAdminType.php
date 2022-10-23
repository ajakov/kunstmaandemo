<?php

namespace App\Form\Pages;

use Kunstmaan\ArticleBundle\Form\AbstractArticlePageAdminType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class BlogPageAdminType extends AbstractArticlePageAdminType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

                        $builder->add('author');
                        $builder->add('categories', EntityType::class, [
            'class' => 'App:BlogCategory',
            'choice_label' => 'name',
            'query_builder' => function(EntityRepository $er) {
                 return $er->createQueryBuilder('t')
                           ->orderBy('t.name', 'ASC')
                 ;
            },
            'multiple' => true,
            'expanded' => false,
            'attr' => [
                 'class' => 'js-advanced-select',
                 'data-placeholder' => 'Choose the related categories'
            ],
            'required' => false
        ]);
                        $builder->add('tags', EntityType::class, [
            'class' => 'App:BlogTag',
            'choice_label' => 'name',
            'query_builder' => function(EntityRepository $er) {
                 return $er->createQueryBuilder('t')
                           ->orderBy('t.name', 'ASC')
                 ;
            },
            'multiple' => true,
            'expanded' => false,
            'attr' => [
                 'class' => 'js-advanced-select',
                 'data-placeholder' => 'Choose the related tags'
            ],
            'required' => false
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
	        'data_class' => 'App\Entity\Pages\BlogPage'
        ]);
    }
}
