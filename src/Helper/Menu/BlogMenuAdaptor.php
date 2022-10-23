<?php

namespace App\Helper\Menu;

use Doctrine\ORM\EntityManagerInterface;
use Kunstmaan\AdminBundle\Helper\Menu\MenuAdaptorInterface;
use Kunstmaan\AdminBundle\Helper\Menu\MenuBuilder;
use Kunstmaan\AdminBundle\Helper\Menu\MenuItem;
use Kunstmaan\AdminBundle\Helper\Menu\TopMenuItem;
use Symfony\Component\HttpFoundation\Request;

class BlogMenuAdaptor implements MenuAdaptorInterface
{
    private $overviewpageIds = null;

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
	    $this->em = $em;
    }

    public function adaptChildren(MenuBuilder $menu, array &$children, MenuItem $parent = null, Request $request = null)
    {
        if (null === $this->overviewpageIds) {
            $overviewPageNodes = $this->em->getRepository('KunstmaanNodeBundle:Node')->findByRefEntityName('App\\Entity\\Pages\\BlogOverviewPage');
            $this->overviewpageIds = array();
            foreach ($overviewPageNodes as $overviewPageNode) {
                $this->overviewpageIds[] = $overviewPageNode->getId();
            }
        }

        if (null !== $parent && 'KunstmaanAdminBundle_modules' === $parent->getRoute()) {
            // submenu
            $menuItem = new TopMenuItem($menu);
            $menuItem
                ->setUniqueId('blog')
                ->setLabel('Blog')
                ->setParent($parent);
            if (in_array($request->attributes->get('_route'), [
                'app_admin_blogitem',
                'app_admin_blogsubscription'
            ])) {
                $menuItem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuItem;

        }

        if (null !== $parent && 'blog' === $parent->getUniqueId()) {
            // Page
            $menuItem = new TopMenuItem($menu);
            $menuItem
		        ->setRoute('app_admin_pages_blogpage')
		        ->setLabel('Pages')
                ->setUniqueId('Blog')
                ->setParent($parent)
            ;
            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
                $menuItem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuItem;

                        // Author
            $menuItem = new TopMenuItem($menu);
            $menuItem
                ->setRoute('app_admin_blogauthor')
                ->setLabel('Author')
                ->setUniqueId('Blog Author')
                ->setParent($parent)
            ;
            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
                $menuItem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuItem;

            // Category
            $menuItem = new TopMenuItem($menu);
            $menuItem
                ->setRoute('app_admin_blogcategory')
                ->setLabel('Category')
                ->setUniqueId('Blog Category')
                ->setParent($parent)
            ;
            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
                $menuItem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuItem;

            // Tag
            $menuItem = new TopMenuItem($menu);
            $menuItem
                ->setRoute('app_admin_blogtag')
                ->setLabel('Tag')
                ->setUniqueId('Blog Tag')
                ->setParent($parent)
            ;
            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
                $menuItem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuItem;


        }

        //don't load children
        if (null !== $parent && 'KunstmaanNodeBundle_nodes_edit' === $parent->getRoute()) {
            foreach ($children as $key => $child) {
                if ('KunstmaanNodeBundle_nodes_edit' === $child->getRoute()){
                    $params = $child->getRouteParams();
                    $id = $params['id'];
                    if (in_array($id, $this->overviewpageIds, true)) {
                        $child->setChildren([]);
                    }
                }
            }
        }
    }
}
