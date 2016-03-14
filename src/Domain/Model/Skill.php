<?php

namespace Domain\Model;

final class Skill
{
    private $name;
    private $slug;

    public function __construct($name)
    {
        $this->name = $name;
        $this->slug = $this->slugify($name);
    }

    private function slugify($string)
    {
        return $string;
    }

}
