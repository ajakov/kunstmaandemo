<?php

namespace App\AdminList;

use Doctrine\ORM\QueryBuilder;
use Kunstmaan\ArticleBundle\AdminList\AbstractArticlePageAdminListConfigurator;

class BlogPageAdminListConfigurator extends AbstractArticlePageAdminListConfigurator
{
    public function getBundleName(): string
    {
        return 'App';
    }

    public function getEntityName(): string
    {
        return 'Pages\BlogPage';
    }

    public function adaptQueryBuilder(QueryBuilder $queryBuilder)
    {
        parent::adaptQueryBuilder($queryBuilder);

        $queryBuilder->setParameter('class', 'App\Entity\Pages\BlogPage');
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getOverviewPageRepository()
    {
        return $this->em->getRepository('App:Pages\BlogOverviewPage');
    }

    public function getListTemplate(): string
    {
        return 'AdminList/BlogPageAdminList/list.html.twig';
    }
}
