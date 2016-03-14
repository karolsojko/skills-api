<?php

namespace Domain\UseCase;

use Domain\Repository\SkillsRepository;
use Domain\UseCase\ListSkills\Responder;
use Domain\UseCase\ListSkills\Command;

class ListSkills
{
    private $skillsRepository;

    public function __construct(SkillsRepository $skillsRepository)
    {
        $this->skillsRepository = $skillsRepository;
    }

    public function execute(Command $command, Responder $responder)
    {
        $skills = $this->skillsRepository->findAll();

        $responder->skillsSuccessfullyRetrieved($skills);
    }
}
