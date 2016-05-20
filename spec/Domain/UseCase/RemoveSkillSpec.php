<?php

namespace spec\Domain\UseCase;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Repository\SkillsRepository;
use Domain\UseCase\RemoveSkill\Responder;
use Domain\UseCase\RemoveSkill\Command;
use Domain\Model\Skill;

class RemoveSkillSpec extends ObjectBehavior
{
    function let(SkillsRepository $skillsRepository)
    {
        $this->beConstructedWith($skillsRepository);
    }

    function it_should_notify_the_responder_is_skill_was_not_found(
        SkillsRepository $skillsRepository,
        Responder $responder
    ) {
        $skillsRepository->findOneBy(['slug' => $slug = 'php'])->willReturn(null);

        $responder->skillNotFound($slug)->shouldBeCalled();

        $this->execute(new Command($slug), $responder);
    }

    function it_should_remove_a_skill_and_notify_the_responder(
        SkillsRepository $skillsRepository,
        Responder $responder
    ) {
        $skillsRepository
            ->findOneBy(['slug' => $slug = 'php'])
            ->willReturn($skill = new Skill('php', 'php'));

        $skillsRepository
            ->remove($skill)
            ->shouldBeCalled();

        $responder
            ->skillSuccessfullyRemoved($slug)
            ->shouldBeCalled();

        $this->execute(new Command($slug), $responder);
    }
}
