<?php

namespace PhpProgrammist\YandexTurboRssGeneratorBundle;

use PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\BasePageInterface;

class RssItem
{
    private $id;
    private $link;
    private $topic;
    private $pubDate;
    private $content;
    private $breadcrumbs = [];
    
    /**
     * RssItem constructor.
     *
     * @param $id int - unique ID of page
     * @param $link string - path to page without host and schema
     * @param $topic string - subject/title of page
     * @param $pubDate int - unix-timestamp
     * @param $content string - text of page
     */
    public function __construct(int $id, string $link, string $topic, int $pubDate, string $content)
    {
        $this->id      = $id;
        $this->link    = $link;
        $this->topic   = $topic;
        $this->pubDate = $pubDate;
        $this->content = $content;
    }
    /**
     * RssItem addBreadcrumbs.
     *
     * @param $link string - path to page without host and schema
     * @param $name string - subject/title of page
     */
    public function addBreadcrumbs(string $link, string $name)
    {
        $this->breadcrumbs[$link] = $name;
    }
    
    public function setAllBreadcrumbs(string $main_page_name, BasePageInterface $base_page)
    {
        $this->addBreadcrumbs('/', $main_page_name);
        $this->addBreadcrumbs($base_page->getPath(), $base_page->getName());
        $this->addBreadcrumbs($this->getLink(), $this->getTopic());
    }
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }
    
    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->topic;
    }
    
    /**
     * @return int
     */
    public function getPubDate(): int
    {
        return $this->pubDate;
    }
    
    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
    
    /**
     * @return array
     */
    public function getBreadcrumbs(): array
    {
        return $this->breadcrumbs;
    }
}
