<?php

namespace CubicMushroom\Symfony\StripeBundle\Form\Extension;

/**
 * Class GlobalsExtension
 *
 * @package CubicMushroom\Symfony\StripeBundle
 *
 * @see     \spec\CubicMushroom\Symfony\StripeBundle\Form\Extension\GlobalsExtensionSpec
 */
class GlobalsExtension extends \Twig_Extension
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
        return 'cm_stripe.globals';
    }


    public function getGlobals()
    {
        return [
            'cm_stripe_api_public_key_script' =>
                "<script type=\"text/javascript\">Stripe.setPublishableKey('{$this->stripePublicKey}');</script>",
        ];
    }


}
