<?php
namespace PhpProgrammist\FileSqlLoggerBundle\Tests;

use PhpProgrammist\YandexTurboRssGeneratorBundle\YandexTurboRssGenerator;
use PhpProgrammist\YandexTurboRssGeneratorBundle\YandexTurboRssGeneratorBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class FunctionalTest extends TestCase
{
    public function testServiceWiring()
    {
        $kernel = new TestingKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();
        $service = $container->get('php_programmist_yandex_turbo_rss_generator.yandex_turbo_rss_generator');
        $this->assertInstanceOf(YandexTurboRssGenerator::class, $service);
    }
}
class TestingKernel extends Kernel
{
    use MicroKernelTrait;
    public function registerBundles()
    {
        return [
            new YandexTurboRssGeneratorBundle(),
            new FrameworkBundle(),
            new TwigBundle()
        ];
    }
    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $c->loadFromExtension('framework', [
            'secret' => 'F00',
            'router' => ['utf8'=>true],
        ]);
        $loader->load(__DIR__.'/config/services_test.yaml');
    }
    
    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
    
    }
}