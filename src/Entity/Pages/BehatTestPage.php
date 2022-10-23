<?php

namespace App\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;

use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Symfony\Component\Form\AbstractType;
use App\Form\Pages\BehatTestPageAdminType;

/**
 * BehatTestPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_behat_test_pages")
 */
class BehatTestPage extends AbstractPage implements HasPageTemplateInterface
{

    /**
     * {@inheritdoc}
     */
    public function getDefaultAdminType()
    {
        return BehatTestPageAdminType::class;
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
                'name'  => 'HomePage',
                'class' => 'App\Entity\Pages\HomePage'
            ),
            array(
                'name'  => 'ContentPage',
                'class' => 'App\Entity\Pages\ContentPage'
            ),
            array(
                'name'  => 'FormPage',
                'class' => 'App\Entity\Pages\FormPage'
            ),
        );
    }

    /**
     * @return string[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function getPageTemplates()
    {
        return array('behat-test-page');
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return '';
    }
}
