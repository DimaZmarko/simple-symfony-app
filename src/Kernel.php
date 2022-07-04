<?php

namespace App;

use App\Service\ReportStrategy\ReportStrategyInterface;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function build(ContainerBuilder $container)
    {
        parent::build($container);
//        $aa = 'app.report2';
//        var_dump($aa);
//        $container->registerForAutoconfiguration(ReportStrategyInterface::class)
//            ->addTag('app.report2');
    }
}
