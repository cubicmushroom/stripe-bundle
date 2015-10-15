<?php

namespace spec\CubicMushroom\Symfony\StripeBundle\Form\Type;

use CubicMushroom\Payments\Stripe\Command\Payment\TakePaymentCommand;
use CubicMushroom\Symfony\StripeBundle\Form\Type\StripeType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Class StripeTypeSpec
 *
 * @package CubicMushroom\Symfony\StripeBundle
 *
 * @see     \CubicMushroom\Symfony\StripeBundle\Form\Type\StripeType
 */
class StripeTypeSpec extends ObjectBehavior
{
    /**
     * @see StripeType
     */
    function it_is_initializable()
    {
        $this->shouldHaveType(StripeType::class);
    }


    /**
     * @see StripeType
     */
    function it_should_be_a_symfony_form_type()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->shouldBeAnInstanceOf(AbstractType::class);
    }


    /**
     * @uses StripeType::getName()
     */
    function it_should_return_name()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->getName()->shouldReturn('cm_stripe_stripe');
    }


    /**
     * @uses StripeType::setDefaultOptions()
     */
    function it_should_set_defaults(OptionsResolverInterface $resolver)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->setDefaultOptions($resolver);

        /** @noinspection PhpUndefinedMethodInspection */
        $resolver->setDefaults(['data_class' => TakePaymentCommand::class])->shouldHaveBeenCalled();
    }
}
