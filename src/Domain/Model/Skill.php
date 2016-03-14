<?php

namespace Domain\Model;

use Ramsey\Uuid\Uuid;

class Skill
{
    private $id;
    private $name;
    private $slug;

    public function __construct($name, $slug)
    {
        $uuid = Uuid::uuid4();
        $this->id = $uuid->toString();
        $this->name = $name;
        $this->slug = $slug;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }
}
