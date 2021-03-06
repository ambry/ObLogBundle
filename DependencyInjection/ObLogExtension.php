<?php

namespace Ob\LogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ObLogExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (isset($config['event_class'])) {
          $container->setParameter('ob_log.event.class', $config['event_class']);
        }
        if (isset($config['event_populator_class'])) {
          $container->setParameter('ob_log.event.populator.class', $config['event_populator_class']);
        }
    }

    /**
     * Specify the short name to be used in a config file
     *
     * @return string
     */
    public function getAlias() {
      return 'ob_log';
    }
}
