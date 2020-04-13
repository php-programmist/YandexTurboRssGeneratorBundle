<?php

namespace PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters;

use PhpProgrammist\YandexTurboRssGeneratorBundle\RssItem;

abstract class RssBaseAdapter implements RssAdapterInterface
{
    /**
     * @var RssItem[]
     */
    protected $items;
    
    public function __construct(array $original_items, BasePageInterface $base_page)
    {
        $this->adapt($original_items, $base_page);
    }

    abstract protected function adapt(array $original_items, BasePageInterface $base_page);
    
    /**
     * @return RssItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
    
    protected function addItem(RssItem $item)
    {
        $this->items[] = $item;
    }
}
