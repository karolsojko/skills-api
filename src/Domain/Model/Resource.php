<?php

namespace Domain\Model;

use Ramsey\Uuid\Uuid;

class Resource
{
    private $id;
    private $url;
    private $description;

    public function __construct($url, $description)
    {
        $uuid = Uuid::uuid4();
        $this->id = $uuid->toString();
        $this->url = $url;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
