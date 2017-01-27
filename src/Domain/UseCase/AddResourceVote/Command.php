<?php

namespace Domain\UseCase\AddResourceVote;

class Command
{
    public $slug;
    public $resource_id;
    public $user;
    public $vote;

    public function __construct($slug, $resource_id, $user, $vote)
    {
        $this->slug = $slug;
        $this->resource_id = $resource_id;
        $this->user = $user;
        $this->vote = $vote;
    }
}
