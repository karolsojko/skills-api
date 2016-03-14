<?php

namespace Domain\Repository;

use Domain\Model\Skill;

interface SkillsRepository
{
    public function add(Skill $skill);

    public function findAll();
}
