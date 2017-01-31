<?php

namespace Domain\UseCase\AddResourceVote;

class Command
{
    public $slug;
    public $resourceId;
    public $user;
    public $vote;

    public function __construct($slug, $resourceId, $user, $vote)
    {
        $this->slug = $slug;
        $this->resourceId = $resourceId;
        $this->user = $user;
        $this->vote = $vote;
    }
}
