<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Kunstmaan\ArticleBundle\Entity\AbstractTag;
use App\Form\BlogTagAdminType;

/**
 * @ORM\Entity()
 * @ORM\Table(name="app_blog_tags", uniqueConstraints={@ORM\UniqueConstraint(name="blog_tag_name_idx", columns={"name"})})
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class BlogTag extends AbstractTag
{
    public function getAdminType(): string
    {
        return BlogTagAdminType::class;
    }
}
