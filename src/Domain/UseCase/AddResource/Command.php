<?php

namespace Domain\UseCase\AddResource;

class Command
{
    public $slug;
    public $url;
    public $description;

    public function __construct($slug, $url, $description)
    {
        $this->slug = $slug;
        $this->url = $url;
        $this->description = $description;
    }
}
