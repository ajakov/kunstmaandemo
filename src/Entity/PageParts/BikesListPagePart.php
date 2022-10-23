<?php

namespace App\Entity\PageParts;

use Doctrine\ORM\Mapping as ORM;

/**
 * BikesListPagePart
 *
 * @ORM\Table(name="app_bikes_list_page_parts")
 * @ORM\Entity
 */
class BikesListPagePart extends AbstractPagePart
{
    /**
     * Get the twig view.
     *
     * @return string
     */
    public function getDefaultView()
    {
        return 'PageParts/BikesListPagePart/view.html.twig';
    }

    /**
     * Get the admin form type.
     *
     * @return \App\Form\PageParts\BikesListPagePartAdminType
     */
    public function getDefaultAdminType()
    {
        return \App\Form\PageParts\BikesListPagePartAdminType::class;
    }
}
