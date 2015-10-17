<?php

namespace spec\CubicMushroom\Symfony\StripeBundle\Form\Type\Command;

use CubicMushroom\Payments\Stripe\Command\Payment\TakePaymentCommand;
use CubicMushroom\Symfony\StripeBundle\Form\Type\Command\TakePaymentType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TakePaymentTypeSpec
 *
 * @package CubicMushroom\Symfony\StripeBundle
 *
 * @see     \CubicMushroom\Symfony\StripeBundle\Form\Type\Command\TakePaymentType
 */
class TakePaymentTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TakePaymentType::class);
    }


    function it_should_extends_symfony_abstract_class()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->shouldBeAnInstanceOf(AbstractType::class);
    }


    /**
     * @uses TakePaymentType::getName()
     */
    function its_name_should_be_cm_stripe_take_payment()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->getName()->shouldReturn('cm_stripe_take_payment');
    }


    function it_should_use_the_take_payment_command_data_class(OptionsResolver $resolver)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->setDefaultOptions($resolver);

        /** @noinspection PhpParamsInspection */
        /** @noinspection PhpUndefinedMethodInspection */
        $resolver->setDefaults(Argument::withEntry('data_class', TakePaymentCommand::class))->shouldHaveBeenCalled();
    }


    function it_should_have_fields(FormBuilderInterface $builder)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('cost', Argument::cetera())->shouldBeCalled()->willReturn($builder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('stripe_form', 'cm_stripe', Argument::withEntry('inherit_data', true))
                ->shouldBeCalled()->willReturn($builder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('description', Argument::cetera())->shouldBeCalled()->willReturn($builder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('userEmail', Argument::cetera())->shouldBeCalled()->willReturn($builder);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->buildForm($builder, []);
    }
}
