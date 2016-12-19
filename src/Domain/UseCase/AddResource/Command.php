<?php

namespace Domain\UseCase\AddResource;

class Command
{
    public $slug;
    public $type;
    public $url;
    public $description;

    public function __construct($slug, $type, $url, $description)
    {
        $this->slug = $slug;
        $this->type = $type;
        $this->url = $url;
        $this->description = $description;
    }
}
