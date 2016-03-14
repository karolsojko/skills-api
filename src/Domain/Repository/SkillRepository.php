<?php

namespace Domain\Repository;

use Domain\Model\Skill;

interface SkillRepository
{
    public function add(Skill $skill);
}
