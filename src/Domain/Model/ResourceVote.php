<?php

namespace Domain\Model;

use Ramsey\Uuid\Uuid;

class ResourceVote
{
    private $id;
    private $user;
    private $vote;

    public function __construct($user, $vote)
    {
        $uuid = Uuid::uuid4();
        $this->id = $uuid->toString();
        $this->user = $user;
        $this->vote = $vote;
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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return integer
     */
    public function getValue()
    {
        return $this->vote;
    }

    /**
     * @param integer $vote
     */
    public function setValue($value)
    {
        $this->vote = $value;
    }
}
