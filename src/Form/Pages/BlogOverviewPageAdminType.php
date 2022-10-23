<?php

namespace App\Form\Pages;

use Kunstmaan\ArticleBundle\Form\AbstractArticleOverviewPageAdminType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogOverviewPageAdminType extends AbstractArticleOverviewPageAdminType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
	        'data_class' => 'App\Entity\Pages\BlogOverviewPage'
        ]);
    }
}
