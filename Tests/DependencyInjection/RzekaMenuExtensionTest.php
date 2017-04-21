<?php
namespace Rzeka\MenuBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Rzeka\MenuBundle\DependencyInjection\RzekaMenuExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RzekaMenuExtensionTest extends TestCase
{
    public function testServicesAreLoaded()
    {
        $container = new ContainerBuilder();
        $extension = new RzekaMenuExtension();

        $extension->load([], $container);

        self::assertTrue($container->hasDefinition('rzeka_menu'));
        self::assertTrue($container->hasDefinition('rzeka_menu.twig.menu'));
    }
}
