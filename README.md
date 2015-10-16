# Stripe Payment Bundle

Symfony bundle to add support for Stripe payments



## Installation

Using composer...

    $ composer require "cubicmushroom/stripe-bundle" "dev-master"
    
## Symfony Setup

Register bundle by adding the following line to your AppKernel file...

    // app/AppKernel.php
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                //...
                new CubicMushroom\Symfony\StripeBundle\CMStripeBundle(),
                //...
            );
            
            // ...
        }
        
        // ...
    }

Add the following to your `app/config.yml` file...

    cm_stripe:
        api_publishable_key:  %cm_stripe.api_publishable_key%
        api_secret_key:       %cm_stripe.api_secret_key%
        
... and the following to your `parameters.yml.dist`/`parameters.yml`, replacing the '~'s with your API details in the 
`parameters.yml` file...

    parameters:
        ...

        # Stripe Bundle
        cm_stripe.api_publishable_key:  ~
        cm_stripe.api_secret_key:       ~

## Load JavaScript library

### Stripe JS file &amp; API key

Add the following twig function call to your page templates for pages that contain Stripe payment forms...

    {{ cm_stripe_api_script() }}
    
This injects the Stripe API JavaScript file, along with your public key into the page.


### Bundle JS file

First ensure the bundle assets are installed using the `app/console assets:install` command.

Add the following script tag to your page's JavaScript files...
 
If using assetic...

    {% javascripts
    {#...#}
    '@CMStripeBundle/Resources/public/js/stripe-bundle.js'
    {#...#}
    output='compiled/js/app.js' %}
    <script type="text/javascript" src="{{ asset_url }}"></script>
    {% endjavascripts %}
    
... or if not using assetic...

    <script type="text/javascript" src="/bundles/cmstripe/js/stripe-bundle.js"></script>
    

## Customising error messages

The error messages displayed by the plugin are attached to the .stripe-errors form element (must be within the related 
form), which is added to the top of the form if it doesn't already exist.

You can customise the format of these errors using the `StripeBundle.EVENTS.FORMAT_ERROR_MSG` event that's fired on the 
Stripe form's form tag by using something similar to the following...

    (function ($) {
        'use strict';
    
        //noinspection JSLint,JSUnusedLocalSymbols
        /**
         *
         * @param {Event} event
         * @param {{errorMessage: string}} errorDetails
         */
        function addStripeErrorFormatting(event, errorDetails) {
            errorDetails.errorMessage = '<div class="alert alert-danger fade in">' + errorDetails.errorMessage + '</div>';
        }
    
        $(function () {
            $('form.stripe-form').on(StripeBundle.EVENTS.FORMAT_ERROR_MSG, addStripeErrorFormatting);
        });
    }(jQuery));
    
