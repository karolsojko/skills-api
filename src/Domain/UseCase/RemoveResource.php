<?php

namespace Domain\UseCase;

use Domain\Repository\SkillsRepository;
use Domain\UseCase\RemoveResource\Command;
use Domain\UseCase\RemoveResource\Responder;

class RemoveResource
{
    private $skillsRepository;

    public function __construct(SkillsRepository $skillsRepository)
    {
        $this->skillsRepository = $skillsRepository;
    }

    public function execute(Command $command, Responder $responder)
    {
        $skill = $this->skillsRepository->find($command->skillId);
        if (empty($skill)) {
            $responder->skillNotFound();
            return;
        }

        $skill->removeResource($command->resourceId);

        $this->skillsRepository->add($skill);

        $responder->resourceSuccessfullyRemoved();
    }
}
