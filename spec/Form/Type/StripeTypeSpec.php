<?php

namespace spec\CubicMushroom\Symfony\StripeBundle\Form\Type;

use CubicMushroom\Payments\Stripe\Command\Payment\TakePaymentCommand;
use CubicMushroom\Symfony\StripeBundle\Form\Type\StripeType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
        $this->getName()->shouldReturn('cm_stripe');
    }


    function it_links_to_the_take_payment_command(OptionsResolverInterface $resolver)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $resolver->setDefaults(['data_class' => TakePaymentCommand::class])
                 ->shouldBeCalled()
                 ->willReturn($resolver);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->setDefaultOptions($resolver);
    }


    /**
     * @uses StripeType::buildForm()
     */
    function it_should_add_the_required_fields(
        /** @noinspection PhpDocSignatureInspection */
        FormBuilderInterface $builder
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('cardNumber', 'cm_stripe_input', ['stripe_data' => 'number'])
                ->shouldBeCalled()
                ->willreturn($builder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('cvc', 'cm_stripe_input', ['stripe_data' => 'cvc', 'label' => 'CVC'])
                ->shouldBeCalled()
                ->willreturn($builder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('expirationMonth', 'cm_stripe_input', ['stripe_data' => 'exp-month'])
                ->shouldBeCalled()
                ->willreturn($builder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('expirationYear', 'cm_stripe_input', ['stripe_data' => 'exp-year'])
                ->shouldBeCalled()
                ->willreturn($builder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('token', 'hidden', ["attr" => ["class" => "stripe-token"]])
                ->shouldBeCalled()
                ->willreturn($builder);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->buildForm($builder, []);
    }
}
