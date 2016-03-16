<?php

namespace Domain\Repository;

use Domain\Model\Skill;

interface SkillsRepository
{
    public function add(Skill $skill);

    public function findAll();

    public function find($id);

    public function remove(Skill $skill);

    public function findOneBy(array $parameters);
}
