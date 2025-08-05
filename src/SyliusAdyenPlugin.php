<?php

/*
 * This file is part of the Sylius Adyen Plugin package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\AdyenPlugin;

use Sylius\AdyenPlugin\DependencyInjection\CompilerPass\AuthenticationManagerPolyfillPass;
use Sylius\AdyenPlugin\DependencyInjection\CompilerPass\MessageBusPolyfillPass;
use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SyliusAdyenPlugin extends Bundle
{
    use SyliusPluginTrait;

    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(
            new MessageBusPolyfillPass(),
            PassConfig::TYPE_BEFORE_OPTIMIZATION,
            1,
        );

        $container->addCompilerPass(
            new AuthenticationManagerPolyfillPass(),
            PassConfig::TYPE_BEFORE_OPTIMIZATION,
            1,
        );
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
