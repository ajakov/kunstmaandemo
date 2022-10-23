<?php

namespace App\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\NodeBundle\Entity\HomePageInterface;
use Kunstmaan\NodeSearchBundle\Helper\SearchTypeInterface;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Symfony\Component\Form\AbstractType;
use App\Form\Pages\HomePageAdminType;

/**
 * HomePage
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_home_pages")
 */
class HomePage extends AbstractPage implements HasPageTemplateInterface, SearchTypeInterface, HomePageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDefaultAdminType()
    {
        return HomePageAdminType::class;
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array(
            [
                'name' => 'BlogOverviewPage',
                'class'=> 'App\Entity\Pages\BlogOverviewPage'
            ],
        
            array(
                'name'  => 'ContentPage',
                'class' => 'App\Entity\Pages\ContentPage'
            ),
            array(
                'name'  => 'FormPage',
                'class' => 'App\Entity\Pages\FormPage'
            ),
            array(
                'name'  => 'BehatTestPage',
                'class' => 'App\Entity\Pages\BehatTestPage'
            )
        );
    }

    /**
     * @return string[]
     */
    public function getPagePartAdminConfigurations()
    {
	    return array(
		'header',
		'section1',
		'section2',
		'section3',
		'section4',
		'section5'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function getPageTemplates()
    {
    	return array('homepage');
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return 'Pages/HomePage/view.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchType()
    {
	    return 'Home';
    }
}
