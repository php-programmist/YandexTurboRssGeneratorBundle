<?php

namespace PhpProgrammist\YandexTurboRssGeneratorBundle;

use PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\BasePageInterface;
use PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\RssAdapterInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class YandexTurboRssGenerator
{
    /**
     * @var Environment
     */
    protected $twig;
    protected $template = '@YandexTurboRssGenerator/default/rss.xml.twig';
    /**
     * @var int
     */
    protected $yandex_id;
    /**
     * @var string
     */
    protected $language;
    /**
     * @var string
     */
    protected $date_format;
    
    public function __construct(
        Environment $twig,
        int $yandex_id = 0,
        ?string $language = null,
        ?string $date_format = null
    ) {
        $this->twig        = $twig;
        $this->yandex_id   = $yandex_id;
        $this->language    = $language;
        $this->date_format = $date_format;
    }
    
    public function render(
        RssAdapterInterface $adapter,
        BasePageInterface $base_page
    ) {
        $xml = $this->twig->render($this->template, [
            'base_page'   => $base_page,
            'items'       => $adapter->getItems(),
            'language'    => $this->language,
            'yandex_id'   => $this->yandex_id,
            'date_format' => $this->date_format,
        ]);
        
        $response = new Response();
        $response->headers->set("Content-type", "text/xml");
        $response->setContent($xml);
        
        return $response;
    }
    
    public function setTemplate(string $template)
    {
        $this->template = $template;
    }
}
