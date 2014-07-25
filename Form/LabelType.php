<?php

namespace UJM\ExoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LabelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'value', 'checkbox', array(
                    'required' => false, 'label' => ' '
                ))
            ->add(
                'scoreRightResponse', 'checkbox', array(
                    'required' => false, 'label' => ' '
                )
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'UJM\ExoBundle\Entity\Label',
            )
        );
    }

    public function getName()
    {
        return 'ujm_exobundle_labeltype';
    }

}