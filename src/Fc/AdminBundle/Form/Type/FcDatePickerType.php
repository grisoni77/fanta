<?php

namespace Fc\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class FcDatePickerType extends AbstractType
{
    public function getDefaultOptions(array $options)
    {
        return array(
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy HH:mm',
            'attr' => array(
                'autocomplete' => 'off',
                'class' => 'fc_date_picker',
            ),
        );
    }

    public function getParent()
    {
        return 'date';
    }

    public function getName()
    {
        return 'fc_type_date_picker';
    }
}