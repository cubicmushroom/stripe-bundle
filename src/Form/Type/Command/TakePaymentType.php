<?php

namespace CubicMushroom\Symfony\StripeBundle\Form\Type\Command;

use CubicMushroom\Payments\Stripe\Command\Payment\TakePaymentCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class TakePaymentType
 *
 * @package CubicMushroom\Symfony\StripeBundle
 *
 * @see     \spec\CubicMushroom\Symfony\StripeBundle\Form\Type\Command\TakePaymentTypeSpec
 */
class TakePaymentType extends AbstractType
{
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'cm_stripe_take_payment';
    }


    /**
     * Sets the form defaults
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => TakePaymentCommand::class]);
    }


    /**
     * Here for support from Symfony 3.0+
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $this->setDefaultOptions($resolver);
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cost')
            ->add('stripe_form', 'cm_stripe', ['inherit_data' => true])
            ->add('description', 'hidden')
            ->add('userEmail', 'email');
    }
}
