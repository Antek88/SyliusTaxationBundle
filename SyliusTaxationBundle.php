<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\TaxationBundle;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Bundle\TaxationBundle\DependencyInjection\Compiler\RegisterCalculatorsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Taxation system for ecommerce Symfony2 applications.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class SyliusTaxationBundle extends Bundle
{
    /**
     * Return array of currently supported drivers.
     *
     * @return array
     */
    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM
        );
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'Sylius\Bundle\TaxationBundle\Model\TaxCategoryInterface' => 'sylius_taxation.model.category.class',
            'Sylius\Bundle\TaxationBundle\Model\TaxRateInterface'     => 'sylius_taxation.model.rate.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('sylius_taxation', $interfaces));
        $container->addCompilerPass(new RegisterCalculatorsPass());
    }
}