<?php

namespace CubicMushroom\Symfony\StripeBundle\Form\Extension;

/**
 * Class GlobalsExtension
 *
 * @package CubicMushroom\Symfony\StripeBundle
 *
 * @see     \spec\CubicMushroom\Symfony\StripeBundle\Form\Extension\StripeScriptTagsExtensionSpec
 */
class StripeScriptTagsExtension extends \Twig_Extension
{
    /**
     * @var string
     */
    protected $stripePublicKey;


    /**
     * GlobalsExtension constructor.
     *
     * @param $stripePublicKey
     */
    public function __construct($stripePublicKey)
    {
        if (empty($stripePublicKey)) {
            throw new \RuntimeException('Stripe API key must be provided');
        }

        $this->stripePublicKey = $stripePublicKey;
    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'cm_stripe.script_functions';
    }


    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            'cm_stripe_api_script' => new \Twig_SimpleFunction(
                'cm_stripe_api_script',
                function () {
                    echo '<script type="text/javascript" src="https://js.stripe.com/v2/"></script>'.
                         "<script type=\"text/javascript\">Stripe.setPublishableKey('{$this->stripePublicKey}');</script>";
                }
            ),
        ];
    }
}
