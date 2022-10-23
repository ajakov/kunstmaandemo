<?php

namespace App\AdminList;

use Doctrine\ORM\EntityManagerInterface;
use App\Form\BlogTagAdminType;
use Kunstmaan\AdminBundle\Helper\Security\Acl\AclHelper;
use Kunstmaan\ArticleBundle\AdminList\AbstractArticleTagAdminListConfigurator;

class BlogTagAdminListConfigurator extends AbstractArticleTagAdminListConfigurator
{
    public function __construct(EntityManagerInterface $em, AclHelper $aclHelper)
    {
        parent::__construct($em, $aclHelper);
        $this->setAdminType(BlogTagAdminType::class);
    }

    public function getBundleName(): string
    {
        return 'App';
    }

    public function getEntityName(): string
    {
        return 'BlogTag';
    }
}
