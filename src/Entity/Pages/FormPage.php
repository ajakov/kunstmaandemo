<?php

namespace App\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\FormBundle\Entity\AbstractFormPage;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Symfony\Component\Form\AbstractType;
use App\Form\Pages\FormPageAdminType;

/**
 * FormPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_form_pages")
 */
class FormPage extends AbstractFormPage implements HasPageTemplateInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDefaultAdminType()
    {
        return FormPageAdminType::class;
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return [
            [
                'name'  => 'ContentPage',
                'class' => 'App\Entity\Pages\ContentPage'
            ],
            [
                'name'  => 'FormPage',
                'class' => 'App\Entity\Pages\FormPage'
            ]
        ];
    }

    /**
     * @return string[]
     */
    public function getPagePartAdminConfigurations()
    {
        return ['form'];
    }

    /**
     * {@inheritdoc}
     */
    public function getPageTemplates()
    {
        return ['formpage'];
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return 'Pages/FormPage/view.html.twig';
    }
}
