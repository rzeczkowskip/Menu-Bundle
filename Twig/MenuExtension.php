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
     * @param null|string $uniqueKey Used when args are present
     * @param mixed ...$args
     *
     * @return MenuItemInterface
     * @throws InvalidMenuNameException
     */
    public function getMenu(string $name, ?string $uniqueKey = null, ...$args): MenuItemInterface
    {
        if ($uniqueKey && $args) {
            return $this->container->getMenuWithArgs($name, $uniqueKey, ...$args);
        }

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
