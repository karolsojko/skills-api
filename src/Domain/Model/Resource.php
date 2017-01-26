<?php

namespace Domain\Model;

use Ramsey\Uuid\Uuid;

class Resource
{
    private $id;
    private $url;
    private $type;
    private $description;
    private $authorId;

    public function __construct($type, $url, $description, $authorId)
    {
        $uuid = Uuid::uuid4();
        $this->id = $uuid->toString();
        $this->type = $type;
        $this->url = $url;
        $this->description = $description;
        $this->authorId = $authorId;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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

    /**
     * @param string $authorId
     */
    public function setAuthorId(string $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @return string
     */
    public function getAuthorId()
    {
      return $this->authorId;
    }
}
