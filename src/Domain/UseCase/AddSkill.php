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
        $slug = $this->slugify->slugify($command->getName());

        $skill = $this->skillsRepository->findOneBy(['slug' => $slug]);
        if (!empty($skill)) {
            $responder->skillAlreadyExists($skill);
            return;
        }

        $skill = new Skill($command->getName(), $slug);

        $this->skillsRepository->add($skill);

        $responder->skillSuccessfullyAdded($skill);
    }

}
