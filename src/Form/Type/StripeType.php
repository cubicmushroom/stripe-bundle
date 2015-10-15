<?php

namespace CubicMushroom\Symfony\StripeBundle\Form\Type;

use CubicMushroom\Payments\Stripe\Command\Payment\TakePaymentCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Class StripeType
 *
 * @package CubicMushroom\Symfony\StripeBundle\Form\Type
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
        return 'cm_stripe_stripe';
    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => TakePaymentCommand::class]);
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardNumber', 'stripe_input', ['stripe-data' => 'number'])
            ->add('cvc', 'stripe_input', ['stripe-data' => 'cvc', 'label' => 'CVC'])
            ->add('expirationMonth', 'stripe_month', ['stripe-data' => 'exp-month'])
            ->add('expirationYear', 'stripe_year', ['stripe-data' => 'exp-year'])
        ;
    }


}
