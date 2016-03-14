<?php

namespace Domain\UseCase;

use Domain\Repository\SkillRepository;
use Domain\UseCase\AddSkill\Responder;
use Domain\UseCase\AddSkill\Command;
use Domain\Model\Skill;

class AddSkill
{
    private $skillRepository;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function execute(Command $command, Responder $responder)
    {
        $skill = new Skill($command->getName());

        $this->skillRepository->add($skill);

        $responder->skillSuccessfullyAdded($skill);
    }

}
