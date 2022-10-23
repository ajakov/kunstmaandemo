<?php

namespace App\Form\PageParts;

use Symfony\Component\Form\AbstractType;
use Kunstmaan\AdminBundle\Form\WysiwygType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * IntroTextPagePartAdminType
 */
class IntroTextPagePartAdminType extends AbstractType
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting form the
     * top most type. Type extensions can further modify the form.
     * @param FormBuilderInterface $builder The form builder
     * @param array $options The options
     *
     * @see FormTypeExtensionInterface::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('content', WysiwygType::class, array(
            'required' => true,
        ));
    }


    public function getBlockPrefix()
    {
        return 'introtextpageparttype';
    }

    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => '\App\Entity\PageParts\IntroTextPagePart'
        ));
    }
}
