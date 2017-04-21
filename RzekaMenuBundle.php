<?php

namespace Rzeka\MenuBundle;

use Rzeka\MenuBundle\DependencyInjection\Compiler\MenuCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RzekaMenuBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new MenuCompilerPass());
    }
}
