<?php

namespace CubicMushroom\Symfony\StripeBundle\Form\Type;

use CubicMushroom\Payments\Stripe\Command\Payment\TakePaymentCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
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
     * Providing this method for backwards compatibility
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => TakePaymentCommand::class]);
    }


    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $this->setDefaultOptions($resolver);
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardNumber', 'cm_stripe_input', ['stripe_data' => 'number'])
            ->add('cvc', 'cm_stripe_input', ['stripe_data' => 'cvc', 'label' => 'CVC'])
            ->add('expirationMonth', 'cm_stripe_input', ['stripe_data' => 'exp-month'])
            ->add('expirationYear', 'cm_stripe_input', ['stripe_data' => 'exp-year'])
            ->add('token', 'hidden', ['attr' => ['class' => 'stripe-token']]);
    }


    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // We need to add the `stripe-form` classs to the top level form, so that we can hijack the form submit buttons
        $topFormView = $view;
        while (!is_null($topFormView->parent)) {
            $topFormView = $topFormView->parent;
        }

        if (!isset($topFormView->vars['attr']['class'])) {
            $topFormView->vars['attr']['class'] = '';
        }
        $topFormView->vars['attr']['class'] .= 'stripe-form';
    }
}
