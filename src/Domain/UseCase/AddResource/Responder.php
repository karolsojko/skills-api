<?php

namespace Domain\UseCase\AddResource;

use Domain\Model\Skill;

interface Responder
{
    public function skillNotFound();

    public function resourceSuccessfullyAdded(Skill $skill);
}
