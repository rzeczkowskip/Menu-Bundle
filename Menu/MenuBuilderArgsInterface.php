<?php
namespace Rzeka\MenuBundle\Menu;

use Rzeka\Menu\MenuItemInterface;

interface MenuBuilderArgsInterface extends MenuBuilderInterface
{
    /**
     * @param mixed ...$args
     *
     * @return MenuItemInterface
     */
    public function buildWithArgs(...$args): MenuItemInterface;
}
