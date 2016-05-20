<?php

namespace Domain\UseCase\RemoveSkill;

class Command
{
    public $slug;

    public function __construct($slug)
    {
        $this->slug = $slug;
    }
}
