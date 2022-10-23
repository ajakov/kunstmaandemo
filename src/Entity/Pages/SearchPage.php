<?php

namespace App\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Kunstmaan\NodeSearchBundle\Entity\AbstractSearchPage;
use Kunstmaan\NodeSearchBundle\Search\AbstractElasticaSearcher;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @ORM\Entity()
 * @ORM\Table(name="app_search_pages")
 */
class SearchPage extends AbstractSearchPage implements HasPageTemplateInterface
{
    /**
     * return string
     */
    public function getDefaultView()
    {
        return 'Pages/SearchPage/view.html.twig';
    }

    /**
     * @return string[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array('main');
    }

    /**
     * {@inheritdoc}
     */
    public function getPageTemplates()
    {
        return array('searchpage');
    }
}
