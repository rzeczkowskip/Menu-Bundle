<?php
namespace Rzeka\MenuBundle\Tests\Twig;

use PHPUnit\Framework\TestCase;
use Rzeka\Menu\MenuItem;
use Rzeka\MenuBundle\Menu\MenuContainer;
use Rzeka\MenuBundle\Twig\MenuExtension;

class MenuExtensionTest extends TestCase
{
    public function testGetFunctions()
    {
        $extension = new MenuExtension();

        $functions = $extension->getFunctions();

        $expected = [
            [
                'name' => 'rzeka_menu',
                'callable' => [$extension, 'getMenu'],
            ]
        ];

        /**
         * @var int $i
         * @var \Twig_SimpleFunction $function
         */
        foreach ($functions as $i => $function) {
            static::assertInstanceOf(\Twig_SimpleFunction::class, $function);
            static::assertEquals($expected[$i]['name'], $function->getName());
            static::assertEquals($expected[$i]['callable'], $function->getCallable());
        }
    }

    public function testCanSetMenuContainer()
    {
        $extension = new MenuExtension();

        static::assertTrue(method_exists($extension, 'setMenuContainer'));
    }

    public function testGetMenu()
    {
        $extension = new MenuExtension();

        $menu = new MenuItem('');

        $container = $this->createMock(MenuContainer::class);
        $container
            ->method('getMenu')
            ->willReturn($menu);

        $extension->setMenuContainer($container);

        $result = $extension->getMenu('');

        self::assertEquals($menu, $result);
    }
}
