<?php
namespace Rzeka\MenuBundle\Tests;

use PHPUnit\Framework\TestCase;
use Rzeka\MenuBundle\DependencyInjection\Compiler\MenuCompilerPass;
use Rzeka\MenuBundle\RzekaMenuBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RzekaMenuBundleTest extends TestCase
{
    public function testBuildWithCompilerPass()
    {
        $container = $this->createMock(ContainerBuilder::class);
        $container
            ->expects(static::once())
            ->method('addCompilerPass')
            ->with(new MenuCompilerPass());

        $bundle = new RzekaMenuBundle();
        $bundle->build($container);
    }
}
