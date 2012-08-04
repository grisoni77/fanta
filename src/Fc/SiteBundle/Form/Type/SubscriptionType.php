<?php

namespace Fc\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('message', null, array('label' => 'Scrivi un messaggio di presentazione'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fc\FantaBundle\Entity\Subscription'
        ));
    }

    public function getName()
    {
        return 'fc_sitebundle_subscriptiontype';
    }
}
