<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Kunstmaan\ArticleBundle\Entity\AbstractCategory;
use App\Form\BlogCategoryAdminType;

/**
 * @ORM\Entity()
 * @ORM\Table(name="app_blog_categories", uniqueConstraints={@ORM\UniqueConstraint(name="blog_category_name_idx", columns={"name"})})
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class BlogCategory extends AbstractCategory
{
    public function getAdminType(): string
    {
        return BlogCategoryAdminType::class;
    }
}
