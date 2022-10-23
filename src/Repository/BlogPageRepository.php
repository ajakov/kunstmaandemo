<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use Kunstmaan\ArticleBundle\Repository\AbstractArticlePageRepository;

class BlogPageRepository extends AbstractArticlePageRepository
{
    /**
     * Returns an array of all BlogPages
     *
     * @param string $lang
     * @param int    $offset
     * @param int    $limit
     * @param array  $category
     * @param array  $tag
     *
     * @return array
     */
    public function getArticles($lang = null, $offset = null, $limit = null, array $category = null, array $tag = null)
    {
        $q = $this->getArticlesQuery($lang, $offset, $limit, $category, $tag);

        return $q->getResult();
    }

    /**
     * Returns the article query
     *
     * @param string|null $lang
     * @param int         $offset
     * @param int         $limit
     * @param array       $category
     * @param array       $tag
     * @return Query
     */
    public function getArticlesQuery($lang, $offset, $limit, array $category = null, array $tag = null)
    {
        $qb = $this->createQueryBuilder('a')
            ->innerJoin('KunstmaanNodeBundle:NodeVersion', 'v', 'WITH', 'a.id = v.refId')
            ->innerJoin('KunstmaanNodeBundle:NodeTranslation', 't', 'WITH', 't.publicNodeVersion = v.id')
            ->innerJoin('KunstmaanNodeBundle:Node', 'n', 'WITH', 't.node = n.id')
            ->where('t.online = :online')
            ->setParameter('online',true)
            ->andWhere('n.deleted = :deleted')
            ->setParameter('deleted',false)
            ->andWhere('v.refEntityName = :refname')
            ->orderBy('a.date', 'DESC')
            ->setParameter('refname', "App\\Entity\\Pages\\BlogPage");

                if (! is_null($tag) && count($tag)) {
            $qb->leftJoin('a.tags', 'tag')
                ->andWhere('tag.name IN (?1)')
                ->setParameter(1, $tag)
            ;
        }
        
                if (! is_null($category) && count($category)) {
            $qb->leftJoin('a.categories', 'cat')
                ->andWhere('cat.name IN (?2)')
                ->setParameter(2, $category)
            ;
        }
        
        if (!is_null($lang)) {
            $qb
                ->andWhere('t.lang = :lang')
                ->setParameter('lang', $lang)
            ;
        }

        if ($limit) {
            $qb->setMaxResults($limit);

            if ($offset) {
                $qb->setFirstResult($offset);
            }
        }

        return $qb->getQuery();
    }
}
