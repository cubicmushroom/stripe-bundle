<?php

namespace spec\CubicMushroom\Symfony\StripeBundle\Form\Type;

use CubicMushroom\Symfony\StripeBundle\Form\Type\StripeInputType;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class StripeInputTypeSpec
 *
 * @package CubicMushroom\Symfony\StripeBundle
 *
 * @see     \CubicMushroom\Symfony\StripeBundle\Form\Type\StripeInputType
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


    /**
     * @uses StripeType::setDefaultOptions()
     * @uses StripeType::configureOptions()
     */
    function it_could_require_stripe_data_option(
        /** @noinspection PhpDocSignatureInspection */
        OptionsResolverInterface $resolver
    ) {

        /** @noinspection PhpUndefinedMethodInspection */
        $resolver->setDefaults(['mapped' => false])->shouldBeCalled()->willReturn($resolver);
        /** @noinspection PhpUndefinedMethodInspection */
        $resolver->setRequired(['stripe_data'])->shouldBeCalled()->willReturn($resolver);


        /** @noinspection PhpUndefinedMethodInspection */
        $this->setDefaultOptions($resolver);
    }


    function it_should_ensure_no_data_is_submitted()
    {
        throw new PendingException(
            'I\'ve added the ViewTransformer to do this in the buildForm() method, so just need to add the test'
        );
    }


    function it_should_ensure_the_field_name_attribute_is_not_set()
    {
        throw new PendingException('Add test for clearing the field\'s name attribute');
    }
}
