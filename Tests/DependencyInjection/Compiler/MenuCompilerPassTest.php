<?php
namespace Rzeka\MenuBundle\Tests\DependencyInjection\Compiler;

use PHPUnit\Framework\TestCase;
use Rzeka\MenuBundle\DependencyInjection\Compiler\MenuCompilerPass;
use Rzeka\MenuBundle\Menu\MenuBuilderInterface;
use Rzeka\MenuBundle\Menu\MenuContainer;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class MenuCompilerPassTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var Definition|\PHPUnit_Framework_MockObject_MockObject
     */
    private $menuContainer;

    public function setUp()
    {
        parent::setUp();

        $this->container = new ContainerBuilder();
        $this->menuContainer = $this->createMock(Definition::class);
        $this->container->setDefinition('rzeka_menu', $this->menuContainer);
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->container = null;
        $this->menuContainer = null;
    }

    public function testWithoutTaggedServices()
    {
        $this->menuContainer
            ->expects(static::never())
            ->method('addMethodCall');

        $compiler = new MenuCompilerPass();
        $compiler->process($this->container);
    }

    public function testMenuServiceUnavailable()
    {
        $this->menuContainer
            ->expects(static::never())
            ->method('addMethodCall');

        $compiler = new MenuCompilerPass();
        $compiler->process(new ContainerBuilder());
    }

    public function testRegisterBuilder()
    {
        $definition = new Definition(MenuBuilderInterface::class);
        $definition->addTag('rzeka_menu');
        $definitionId = 'app.menu';

        $this->container->setDefinition($definitionId, $definition);

        $this->menuContainer
            ->expects(static::once())
            ->method('addMethodCall')
            ->with('addBuilder', [new Reference($definitionId)]);

        $compiler = new MenuCompilerPass();
        $compiler->process($this->container);
    }
}
