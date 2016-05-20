<?php

namespace Domain\UseCase\RemoveResource;

class Command
{
    public $slug;
    public $resourceId;

    public function __construct($slug, $resourceId)
    {
        $this->slug = $slug;
        $this->resourceId = $resourceId;
    }
}
