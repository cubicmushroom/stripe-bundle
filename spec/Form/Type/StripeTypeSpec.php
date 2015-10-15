<?php

namespace spec\CubicMushroom\Symfony\StripeBundle\Form\Type;

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


    /**
     * @uses StripeType::setDefaultOptions()
     * @uses StripeType::configureOptions()
     */
    function it_could_require_stripe_data_option(
        /** @noinspection PhpDocSignatureInspection */
        OptionsResolverInterface $resolver
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->setDefaultOptions($resolver);

        /** @noinspection PhpUndefinedMethodInspection */
        $resolver->setRequired(['stripe_data'])->shouldHaveBeenCalled();
    }


    /**
     * @uses StripeType::buildForm()
     */
    function it_should_add_the_required_fields(
        /** @noinspection PhpDocSignatureInspection */
        FormBuilderInterface $builder
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('cardNumber', 'cm_stripe_input', ['stripe-data' => 'number'])
                ->shouldBeCalled()
                ->willreturn($builder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('cvc', 'cm_stripe_input', ['stripe-data' => 'cvc', 'label' => 'CVC'])
                ->shouldBeCalled()
                ->willreturn($builder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('expirationMonth', 'cm_stripe_input', ['stripe-data' => 'exp-month'])
                ->shouldBeCalled()
                ->willreturn($builder);
        /** @noinspection PhpUndefinedMethodInspection */
        $builder->add('expirationYear', 'cm_stripe_input', ['stripe-data' => 'exp-year'])
                ->shouldBeCalled()
                ->willreturn($builder);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->buildForm($builder, []);
    }
}
