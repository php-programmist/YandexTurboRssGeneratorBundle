<?php

namespace PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters;

use PhpProgrammist\YandexTurboRssGeneratorBundle\RssItem;

interface RssAdapterInterface
{
    /**
     * @return RssItem[]
     */
    public function getItems(): array;
}
