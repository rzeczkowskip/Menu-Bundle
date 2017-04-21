<?php
namespace Rzeka\MenuBundle\Menu;

use Rzeka\Menu\MenuItemInterface;

interface MenuBuilderInterface
{
    /**
     * @return MenuItemInterface
     */
    public function build(): MenuItemInterface;

    /**
     * @return string
     */
    public function getName(): string;
}
