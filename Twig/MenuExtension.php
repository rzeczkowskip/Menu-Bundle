<?php
namespace Rzeka\MenuBundle\Twig;

use Rzeka\Menu\MenuItemInterface;
use Rzeka\MenuBundle\Exception\InvalidMenuNameException;
use Rzeka\MenuBundle\Menu\MenuContainer;

class MenuExtension extends \Twig_Extension
{
    /**
     * @var MenuContainer
     */
    private $container;

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('rzeka_menu', [$this, 'getMenu']),
        ];
    }

    /**
     * @param string $name
     *
     * @return MenuItemInterface
     * @throws InvalidMenuNameException
     */
    public function getMenu(string $name): MenuItemInterface
    {
        return $this->container->getMenu($name);
    }

    /**
     * @param MenuContainer $menuContainer
     */
    public function setMenuContainer(MenuContainer $menuContainer)
    {
        $this->container = $menuContainer;
    }
}
