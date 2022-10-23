<?php

namespace App\AdminList;

use Kunstmaan\ArticleBundle\AdminList\AbstractArticleAuthorAdminListConfigurator;

class BlogAuthorAdminListConfigurator extends AbstractArticleAuthorAdminListConfigurator
{
    public function getBundleName(): string
    {
        return 'App';
    }

    public function getEntityName(): string
    {
        return 'BlogAuthor';
    }
}
