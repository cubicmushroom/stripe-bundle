<?php

namespace spec\CubicMushroom\Symfony\StripeBundle\Form\Type;

use CubicMushroom\Symfony\StripeBundle\Form\Type\StripeInputType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\AbstractType;

/**
 * Class StripeInputTypeSpec
 *
 * @package CubicMushroom\Symfony\StripeBundle
 *
 * @see \CubicMushroom\Symfony\StripeBundle\Form\Type\StripeInputType
 */
class StripeInputTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StripeInputType::class);
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
        $this->getName()->shouldReturn('cm_stripe_input');
    }


    /**
     * @uses StripeType::getName()
     */
    function it_should_return_its_parent()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->getParent()->shouldReturn('text');
    }
}
