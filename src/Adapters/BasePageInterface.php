<?php

namespace PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters;

interface BasePageInterface
{
    public function getName(): string;
    public function getDescription(): string;
    public function getPath(): string;
}
