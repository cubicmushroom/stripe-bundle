<?php

namespace CubicMushroom\Symfony\StripeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Class StripeType
 *
 * @package CubicMushroom\Symfony\StripeBundle\Form\Type
 *
 * @todo    - Add unit tests for this form, as per http://symfony.com/doc/current/cookbook/form/unit_testing.html
 */
class StripeType extends AbstractType
{
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'cm_stripe';
    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(['stripe_data']);
    }


    /**
     * Providing this for forward compatibility with Symfony 3.0
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $this->setDefaultOptions($resolver);
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardNumber', 'cm_stripe_input', ['stripe-data' => 'number'])
            ->add('cvc', 'cm_stripe_input', ['stripe-data' => 'cvc', 'label' => 'CVC'])
            ->add('expirationMonth', 'cm_stripe_input', ['stripe-data' => 'exp-month'])
            ->add('expirationYear', 'cm_stripe_input', ['stripe-data' => 'exp-year']);
    }


}
