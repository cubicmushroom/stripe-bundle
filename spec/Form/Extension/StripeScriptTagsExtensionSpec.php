<?php

namespace spec\CubicMushroom\Symfony\StripeBundle\Form\Extension;

use CubicMushroom\Symfony\StripeBundle\Form\Extension\StripeScriptTagsExtension;
use PhpSpec\Exception\Example\ErrorException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class StripeScriptTagsExtensionSpec
 *
 * @package CubicMushroom\Symfony\StripeBundle
 *
 * @see \CubicMushroom\Symfony\StripeBundle\Form\Extension\StripeScriptTagsExtension
 */
class StripeScriptTagsExtensionSpec extends ObjectBehavior
{

    const API_PUBLIC_KEY = 'pk_test_lUIS2li2d34c2h4sdsdaHIlb';


    function let()
    {
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $this->beConstructedWith(self::API_PUBLIC_KEY);
    }


    /**
     * @uses StripeScriptTagsExtension::__construct()
     */
    function it_is_initializable()
    {
        $this->shouldHaveType(StripeScriptTagsExtension::class);
    }


    /**
     * @uses StripeScriptTagsExtension::__construct()
     */
    function it_should_extends_the_twig_extension_class()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->shouldBeAnInstanceOf(\Twig_Extension::class);
    }


    function it_should_require_the_users_stripe_api_public_key()
    {
        $this->shouldThrow(ErrorException::class)->during('__construct', []);
    }


    /**
     * @uses StripeScriptTagsExtension::getName()
     */
    function its_name_should_be_cm_stripe_script_functions()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->getName()->shouldReturn('cm_stripe.script_functions');
    }


    /**
     * @uses StripeScriptTagsExtension::getFunctions()
     */
    function it_should_add_the_cm_stripe_api_script_function()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->getFunctions()->shouldReturn([
            'cm_stripe_api_script' => new \Twig_SimpleFunction(
                'cm_stripe_api_script',
                function () {
                    echo '<script type="text/javascript" src="https://js.stripe.com/v2/"></script>'.
                         "<script type=\"text/javascript\">Stripe.setPublishableKey('{$this->stripePublicKey}');</script>";
                }
            )
        ]);
    }
}
