<?php

namespace App\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\NodeSearchBundle\Helper\SearchTypeInterface;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Symfony\Component\Form\AbstractType;
use App\Form\Pages\ContentPageAdminType;

/**
 * ContentPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_content_pages")
 */
class ContentPage extends AbstractPage implements HasPageTemplateInterface, SearchTypeInterface
{
    /**
     * @var \Kunstmaan\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Kunstmaan\MediaBundle\Entity\Media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_image_id", referencedColumnName="id")
     * })
     */
    private $menuImage;

    /**
     * @var string
     *
     * @ORM\Column(name="menu_description", type="text", nullable=true)
     */
    private $menuDescription;
    /**
     * Returns the default backend form type for this page
     *
     * @return string
     */
    public function getDefaultAdminType()
    {
        return ContentPageAdminType::class;
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array (
            array(
                'name'  => 'ContentPage',
                'class' => 'App\Entity\Pages\ContentPage'
            ),
        );
    }

    /**
     * @param \Kunstmaan\MediaBundle\Entity\Media $icon
     */
    public function setMenuImage($image)
    {
        $this->menuImage = $image;
    }

    /**
     * @return \Kunstmaan\MediaBundle\Entity\Media
     */
    public function getMenuImage()
    {
        return $this->menuImage;
    }

    /**
     * @return string
     */
    public function getMenuDescription()
    {
        return $this->menuDescription;
    }

    /**
     * @param string $description
     *
     * @return ContentPage
     */
    public function setMenuDescription($description)
    {
        $this->menuDescription = $description;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchType()
    {
        return 'Page';
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
        return array('contentpage', 'contentpage_with_submenu');
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return 'Pages/ContentPage/view.html.twig';
    }
}
