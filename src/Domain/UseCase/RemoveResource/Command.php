<?php

namespace Domain\UseCase\RemoveResource;

class Command
{
    public $skillId;
    public $resourceId;

    public function __construct($skillId, $resourceId)
    {
        $this->skillId = $skillId;
        $this->resourceId = $resourceId;
    }
}
