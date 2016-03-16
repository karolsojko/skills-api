<?php

namespace Domain\UseCase\AddSkill;

use Domain\Model\Skill;

interface Responder
{
    public function skillSuccessfullyAdded(Skill $skill);

    public function skillAlreadyExists(Skill $skill);
}
