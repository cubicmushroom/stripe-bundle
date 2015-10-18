<?php

namespace CubicMushroom\Symfony\StripeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CMStripeExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

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
