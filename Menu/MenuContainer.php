<?php
namespace Rzeka\MenuBundle\Menu;

use Rzeka\Menu\MenuItemInterface;
use Rzeka\MenuBundle\Exception\InvalidMenuNameException;
use Rzeka\MenuBundle\Exception\MenuBuilderArgumentsUnsupportedException;

class MenuContainer
{
    /**
     * @var MenuItemInterface[]
     */
    private $menu = [];

    /**
     * @var MenuItemInterface[]
     */
    private $menuWithArgs = [];

    /**
     * @var MenuBuilderInterface|MenuBuilderArgsInterface[]
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
     * @param string $name
     * @param string $uniqueKey
     * @param mixed ...$args
     *
     * @return MenuItemInterface
     * @throws InvalidMenuNameException
     */
    public function getMenuWithArgs(string $name, string $uniqueKey, ...$args): MenuItemInterface
    {
        if (array_key_exists($name, $this->builders)) {
            if (!$this->builders[$name] instanceof MenuBuilderArgsInterface) {
                throw new MenuBuilderArgumentsUnsupportedException(sprintf(
                    'Menu %s does not support custom build arguments',
                    $name
                ));
            }

            if (!array_key_exists($name . $uniqueKey, $this->menuWithArgs)) {
                $this->menuWithArgs[$name . $uniqueKey] = $this->builders[$name]->buildWithArgs(...$args);
            }

            return $this->menuWithArgs[$name . $uniqueKey];
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
