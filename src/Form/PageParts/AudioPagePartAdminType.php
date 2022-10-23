<?php

namespace App\Form\PageParts;

use Kunstmaan\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * AudioPagePartAdminType
 */
class AudioPagePartAdminType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('media', MediaType::class, array(
            'mediatype' => 'audio',
            'label' => 'mediapagepart.audio.choose'
        ));
    }


    public function getBlockPrefix()
    {
        return 'audiopageparttype';
    }

    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\PageParts\AudioPagePart',
        ));
    }
}
