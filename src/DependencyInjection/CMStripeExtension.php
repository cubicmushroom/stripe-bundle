<?php

namespace CubicMushroom\Symfony\StripeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CMStripeExtension extends Extension implements PrependExtensionInterface
{


    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {

        // get all bundles
        $bundles = $container->getParameter('kernel.bundles');
        // determine if AcmeGoodbyeBundle is registered
        if (isset($bundles['DoctrineBundle'])) {
            $container->prependExtensionConfig(
                'doctrine',
                [
                    'orm' => [
                        'mappings' => [
                            'CMStripeBundle' => [
                                'type'      => 'xml',
                                'dir'       => 'Resources/config/doctrine',
                                'is_bundle' => true,
                                'prefix'    => 'CubicMushroom\\Payments\\Stripe\\Domain',
                                'alias'     => 'CMStripe',
                            ],
                        ],
                    ],
                ]
            );
        }
    }


    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $container->setParameter('cm_stripe.api_public_key', $config['api_publishable_key']);
        $container->setParameter('cm_stripe.api_secret_key', $config['api_secret_key']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('command_handlers.xml');
        $loader->load('forms.xml');
        $loader->load('gateways.xml');
        $loader->load('services.xml');
        $loader->load('twig_extensions.xml');
    }
}
