<?php
namespace Rzeka\MenuBundle\Menu;

use Rzeka\Menu\MenuItemInterface;
use Rzeka\MenuBundle\Exception\InvalidMenuNameException;

class MenuContainer
{
    /**
     * @var MenuItemInterface[]
     */
    private $menu = [];

    /**
     * @var MenuBuilderInterface[]
     */
    private $builders = [];

    /**
     * @param MenuBuilderInterface $builder
     */
    public function addBuilder(MenuBuilderInterface $builder)
    {
        $this->builders[$builder->getName()] = $builder;
    }

    /**
     * @param string $name
     *
     * @return MenuItemInterface
     * @throws InvalidMenuNameException
     */
    public function getMenu(string $name): MenuItemInterface
    {
        if (array_key_exists($name, $this->builders)) {
            if (!array_key_exists($name, $this->menu)) {
                $this->menu[$name] = $this->builders[$name]->build();
            }

            return $this->menu[$name];
        }

        throw new InvalidMenuNameException(sprintf('Menu %s doesn\'t exist', $name));
    }

    /**
     * @return string[]
     */
    public function getNames(): array
    {
        return array_keys($this->builders);
    }
}
