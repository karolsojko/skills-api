<?php

namespace Domain\UseCase\AddResource;

class Command
{
    public $slug;
    public $type;
    public $url;
    public $description;
    public $authorId;

    public function __construct($slug, $type, $url, $description, $authorId)
    {
        $this->slug = $slug;
        $this->type = $type;
        $this->url = $url;
        $this->description = $description;
        $this->authorId = $authorId;
    }
}
