<?php

namespace Domain\UseCase\AddResourceVote;

use Domain\Model\Skill;
use Domain\Model\Resource;

interface Responder
{
    public function skillNotFound();

    public function resourceNotFound();

    public function resourceVoteSuccessfullyAdded(Skill $skill);
}
