<?php

namespace Infrastructure\ODM\Repository;

use Doctrine\Common\Persistence\ObjectManager;
use Domain\Repository\SkillRepository as SkillsRepositoryInterface;
use Domain\Model\Skill;

class SkillsRepository implements SkillsRepositoryInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function add(Skill $skill)
    {
        $this->manager->persist($skill);
        $this->manager->flush();
    }
}
