<?php
namespace Rzeka\MenuBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MenuCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('rzeka_menu')) {
            return;
        }

        $builders = $container->findTaggedServiceIds(
            'rzeka_menu'
        );

        $definition = $container->findDefinition(
            'rzeka_menu'
        );

        foreach ($builders as $id => $tags) {
            $definition->addMethodCall(
                'addBuilder',
                array(new Reference($id))
            );
        }
    }
}
