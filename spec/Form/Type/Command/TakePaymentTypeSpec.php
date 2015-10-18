<?php

namespace spec\CubicMushroom\Symfony\StripeBundle\Form\Type\Command;

use CubicMushroom\Payments\Stripe\Command\Payment\TakePaymentCommand;
use CubicMushroom\Symfony\StripeBundle\Form\DataTransformer\MoneyTransformer;
use CubicMushroom\Symfony\StripeBundle\Form\Type\Command\TakePaymentType;
use CubicMushroom\Symfony\ValueObjectsBundle\Form\DataTransformer\EmailTransformer;
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


    function it_should_have_fields(
        FormBuilderInterface $builder,
        FormBuilderInterface $costBuilder,
        FormBuilderInterface $emailBuilder
    ) {
        // Cost field
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->create('cost', 'money', Argument::cetera())->shouldBeCalled()->willReturn($costBuilder);
        /** @noinspection PhpParamsInspection */
        /** @noinspection PhpUndefinedMethodInspection */
        $costBuilder->addViewTransformer(Argument::type(MoneyTransformer::class))->willReturn($costBuilder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add($costBuilder)->shouldBeCalled()->willReturn($builder);

        // Stripe field
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add(
            'stripe_form',
            'cm_stripe',
            Argument::that(
            /**
             * Checks expected options
             */
                function (array $options) {
                    $expectedOptions = [
                        'inherit_data' => true,
                        'label' => false,
                    ];
                    foreach ($expectedOptions as $option => $value) {
                        if (!isset($options[$option]) || $options[$option] !== $value) {
                            return false;
                        }
                    }

                    return true;
                }
            )
        )
                ->shouldBeCalled()->willReturn($builder);

        // Description field
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('description', Argument::cetera())->shouldBeCalled()->willReturn($builder);

        // User email field
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->create('userEmail', Argument::cetera())->shouldBeCalled()->willReturn($emailBuilder);
        /** @noinspection PhpParamsInspection */
        /** @noinspection PhpUndefinedMethodInspection */
        $emailBuilder->addViewTransformer(Argument::type(EmailTransformer::class))->willReturn($emailBuilder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add($emailBuilder)->shouldBeCalled()->willReturn($builder);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->buildForm($builder, []);
    }
}
