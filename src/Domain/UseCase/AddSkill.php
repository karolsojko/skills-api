<?php

namespace Domain\UseCase;

use Domain\Repository\SkillsRepository;
use Domain\UseCase\AddSkill\Responder;
use Domain\UseCase\AddSkill\Command;
use Domain\Model\Skill;
use Cocur\Slugify\Slugify;

class AddSkill
{
    private $skillsRepository;
    private $slugify;

    public function __construct(
        SkillsRepository $skillsRepository,
        Slugify $slugify
    ) {
        $this->skillsRepository = $skillsRepository;
        $this->slugify = $slugify;
    }

    public function execute(Command $command, Responder $responder)
    {
        $skill = new Skill(
            $command->getName(),
            $this->slugify->slugify($command->getName())
        );

        $this->skillsRepository->add($skill);

        $responder->skillSuccessfullyAdded($skill);
    }

}
