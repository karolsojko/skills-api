<?php

namespace Domain\UseCase;

use Domain\Model\ResourceVote;
use Domain\Repository\SkillsRepository;
use Domain\UseCase\AddResourceVote\Command;
use Domain\UseCase\AddResourceVote\Responder;

class AddResourceVote
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

        $resourceVote = new ResourceVote($command->user, $command->vote);

        $skill->addResourceVote($command->resource_id, $resourceVote);

        $this->skillsRepository->add($skill);

        $responder->resourceVoteSuccessfullyAdded($skill);
    }
}
