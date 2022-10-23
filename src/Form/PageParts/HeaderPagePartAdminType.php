<?php

namespace App\Form\PageParts;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\PageParts\HeaderPagePart;

/**
 * HeaderPagePartAdminType
 */
class HeaderPagePartAdminType extends AbstractType
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

        $names = HeaderPagePart::$supportedHeaders;
        array_walk($names, function(&$item) { $item = 'Header ' . $item; });

        $builder->add('niv', ChoiceType::class, array(
            'label' => 'pagepart.header.type',
            'choices' => array_combine($names, HeaderPagePart::$supportedHeaders),
            'required' => true,
        ));
        $builder->add('title', TextType::class, array(
            'label' => 'pagepart.header.title',
            'required' => true
        ));
    }


    public function getBlockPrefix()
    {
        return 'headerpageparttype';
    }

    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => '\App\Entity\PageParts\HeaderPagePart'
        ));
    }
}
