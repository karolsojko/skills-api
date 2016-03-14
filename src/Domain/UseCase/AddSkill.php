<?php

namespace Domain\UseCase;

use Domain\Repository\SkillRepository;
use Domain\UseCase\AddSkill\Responder;
use Domain\UseCase\AddSkill\Command;
use Domain\Model\Skill;
use Cocur\Slugify\Slugify;

class AddSkill
{
    private $skillRepository;
    private $slugify;

    public function __construct(
        SkillRepository $skillRepository,
        Slugify $slugify
    ) {
        $this->skillRepository = $skillRepository;
        $this->slugify = $slugify;
    }

    public function execute(Command $command, Responder $responder)
    {
        $skill = new Skill(
            $command->getName(),
            $this->slugify->slugify($command->getName())
        );

        $this->skillRepository->add($skill);

        $responder->skillSuccessfullyAdded($skill);
    }

}
