<?php

namespace App\Form;

use Kunstmaan\ArticleBundle\Form\AbstractCategoryAdminType;

class BlogCategoryAdminType extends AbstractCategoryAdminType
{
    public function getBlockPrefix(): string
{
    return 'blog_category_form';
}
}
