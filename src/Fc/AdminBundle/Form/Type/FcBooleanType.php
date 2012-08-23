<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Fc\AdminBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType as FormChoiceType;
use Symfony\Component\Translation\TranslatorInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\AdminBundle\Form\Type\BooleanType;

class FcBooleanType extends BooleanType
{
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'choices' => array(
                1  => 'label_type_yes',
                0   => 'label_type_no',
            )
        ));
    }

    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fc_type_boolean';
    }
}
