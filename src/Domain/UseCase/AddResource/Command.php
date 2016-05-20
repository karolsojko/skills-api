<?php

namespace Domain\UseCase\AddResource;

class Command
{
    public $skillId;
    public $url;
    public $description;

    public function __construct($skillId, $url, $description)
    {
        $this->skillId = $skillId;
        $this->url = $url;
        $this->description = $description;
    }
}
