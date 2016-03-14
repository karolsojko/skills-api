<?php

namespace spec\Domain\UseCase;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Repository\SkillsRepository;
use Domain\UseCase\ListSkills\Responder;
use Domain\UseCase\ListSkills\Command;
use Domain\Model\Skill;

class ListSkillsSpec extends ObjectBehavior
{
    function let(SkillsRepository $skillsRepository)
    {
        $this->beConstructedWith($skillsRepository);
    }

    function it_should_list_skills_and_notify_the_responder(
        SkillsRepository $skillsRepository,
        Responder $responder
    ) {
        $skillsRepository
            ->findAll()
            ->willReturn($skills = ['php']);

        $responder
            ->skillsSuccessfullyRetrieved($skills)
            ->shouldBeCalled();

        $this->execute(new Command(), $responder);
    }
}
