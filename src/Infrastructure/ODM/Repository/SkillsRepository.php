<?php

namespace Infrastructure\ODM\Repository;

use Doctrine\Common\Persistence\ObjectManager;
use Domain\Repository\SkillsRepository as SkillsRepositoryInterface;
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

    public function findAll()
    {
        return $this->manager->getRepository(Skill::class)->findBy([]);
    }
}
