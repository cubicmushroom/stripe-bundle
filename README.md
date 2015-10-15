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

### Stripe JS file

Add the following to script tag to your page templates that contain Stripe payment forms...

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

Note from the Stripe website...

To prevent problems with some older browsers, we recommend putting the script tag in the \<head> tag of your page, or as 
a direct descendant of the \<body> at the end of your page.


### Stripe API key

Just below where you added the above script tag, add the following line,which injects your public API key into the page 
so that the Stripe JavaScript can make use of it...
 
    {{ cm_stripe_api_public_key_script }}


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
    
