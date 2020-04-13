<?php

namespace PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters;

class BasePage implements BasePageInterface
{
    private $name;
    private $description;
    private $path;
   
    public function __construct(string $name, string $description, string $path)
    {
        $this->name        = $name;
        $this->description = $description;
        $this->path        = $path;
    }
    
    public function getPath(): string
    {
        return $this->path;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }
}
