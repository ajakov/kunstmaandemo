<?php

namespace App\Entity\Pages;

use App\Form\Pages\BlogOverviewPageAdminType;
use App\ViewDataProvider\BlogPageViewDataProvider;
use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\ArticleBundle\Entity\AbstractArticleOverviewPage;
use Kunstmaan\NodeBundle\Entity\CustomViewDataProviderInterface;
use Kunstmaan\NodeSearchBundle\Helper\SearchTypeInterface;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Kunstmaan\PagePartBundle\PagePartAdmin\AbstractPagePartAdminConfigurator;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogOverviewPageRepository")
 * @ORM\Table(name="app_blog_overview_pages")
 */
class BlogOverviewPage extends AbstractArticleOverviewPage implements HasPageTemplateInterface, SearchTypeInterface, CustomViewDataProviderInterface
{
    public function getPagePartAdminConfigurations(): array
    {
        return ['blogmain'];
    }

    public function getPageTemplates(): array
    {
        return ['blogoverviewpage'];
    }

    /**
     * @param \Doctrine\ORM\EntityManagerInterface $em
     *
     * @return \Doctrine\Persistence\ObjectRepository
     */
    public function getArticleRepository($em)
    {
        return $em->getRepository('App:Pages\BlogPage');
    }

    public function getDefaultView(): string
    {
        return 'Pages/BlogOverviewPage/view.html.twig';
    }

    public function getSearchType(): string
    {
        return 'Blog';
    }

    public function getDefaultAdminType(): string
    {
        return BlogOverviewPageAdminType::class;
    }

    public function getViewDataProviderServiceId(): string
    {
        return BlogPageViewDataProvider::class;
    }
}
