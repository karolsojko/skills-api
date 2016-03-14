<?php

namespace spec\Domain\UseCase;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Repository\SkillRepository;
use Domain\UseCase\AddSkill\Responder;
use Domain\UseCase\AddSkill\Command;
use Domain\Model\Skill;

class AddSkillSpec extends ObjectBehavior
{
    function let(SkillRepository $skillRepository)
    {
        $this->beConstructedWith($skillRepository);
    }

    function it_should_add_a_skill_and_notify_the_responder(
        SkillRepository $skillRepository,
        Responder $responder
    ) {
        $skillRepository
            ->add(Argument::type(Skill::class))
            ->shouldBeCalled();

        $responder
            ->skillSuccessfullyAdded(Argument::type(Skill::class))
            ->shouldBeCalled();

        $this->execute(new Command($name = 'PHP'), $responder);
    }
}
