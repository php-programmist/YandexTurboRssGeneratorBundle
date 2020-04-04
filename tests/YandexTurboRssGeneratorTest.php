<?php

use PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\BasePage;
use PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\RssAdapterInterface;
use PhpProgrammist\YandexTurboRssGeneratorBundle\YandexTurboRssGenerator;
use PHPUnit\Framework\TestCase;

class YandexTurboRssGeneratorTest  extends TestCase
{
    public function testRender()
    {
        $twig = $this->createMock(Twig\Environment::class);
        $twig->expects($this->once())->method('render');
        $generator = new YandexTurboRssGenerator($twig,123456,'ru-RU','D, d M Y H:i:s e');
        
        $adapter = $this->createMock(RssAdapterInterface::class);
        $adapter->expects($this->once())->method('getItems');
        
        $base_page = new BasePage('News','Description','/news/');
        $generator->render($adapter,$base_page);
    }
}