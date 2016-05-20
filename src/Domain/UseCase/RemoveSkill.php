<?php

namespace Domain\UseCase;

use Domain\Repository\SkillsRepository;
use Domain\UseCase\RemoveSkill\Responder;
use Domain\UseCase\RemoveSkill\Command;

class RemoveSkill
{
    private $skillsRepository;

    public function __construct(SkillsRepository $skillsRepository)
    {
        $this->skillsRepository = $skillsRepository;
    }

    public function execute(Command $command, Responder $responder)
    {
        $skill = $this->skillsRepository->findOneBy(['slug' => $command->slug]);
        if (empty($skill)) {
            $responder->skillNotFound($command->slug);
            return;
        }

        $this->skillsRepository->remove($skill);

        $responder->skillSuccessfullyRemoved($command->slug);
    }
}
