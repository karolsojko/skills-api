<?php

namespace Domain\UseCase;

use Domain\Model\Resource;
use Domain\Repository\SkillsRepository;
use Domain\UseCase\AddResource\Command;
use Domain\UseCase\AddResource\Responder;

class AddResource
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
            $responder->skillNotFound();
            return;
        }

        $resource = new Resource($command->type, $command->url, $command->description, $command->authorId);

        $skill->addResource($resource);

        $this->skillsRepository->add($skill);

        $responder->resourceSuccessfullyAdded($skill);
    }
}
