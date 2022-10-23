<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\ArticleBundle\Entity\AbstractAuthor;
use App\Form\BlogAuthorAdminType;

/**
 * @ORM\Entity()
 * @ORM\Table(name="app_blog_authors")
 */
class BlogAuthor extends AbstractAuthor
{
    public function getAdminType(): string
    {
        return BlogAuthorAdminType::class;
    }
}
