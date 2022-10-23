<?php

namespace App\Form;

use Kunstmaan\ArticleBundle\Form\AbstractAuthorAdminType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogAuthorAdminType extends AbstractAuthorAdminType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
	        'data_class' => 'App\Entity\BlogAuthor'
        ]);
    }
}
