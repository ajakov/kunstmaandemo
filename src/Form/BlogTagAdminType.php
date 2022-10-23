<?php

namespace App\Form;

use Kunstmaan\ArticleBundle\Form\AbstractTagAdminType;

class BlogTagAdminType extends AbstractTagAdminType
{
    public function getBlockPrefix(): string
    {
        return 'blog_tag_form';
    }
}
