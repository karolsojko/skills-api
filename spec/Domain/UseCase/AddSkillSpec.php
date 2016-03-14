<?php

namespace spec\Domain\UseCase;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Repository\SkillsRepository;
use Domain\UseCase\AddSkill\Responder;
use Domain\UseCase\AddSkill\Command;
use Domain\Model\Skill;
use Cocur\Slugify\Slugify;

class AddSkillSpec extends ObjectBehavior
{
    function let(
        SkillsRepository $skillsRepository,
        Slugify $slugify
    ) {
        $this->beConstructedWith($skillsRepository, $slugify);
    }

    function it_should_add_a_skill_and_notify_the_responder(
        SkillsRepository $skillsRepository,
        Responder $responder
    ) {
        $skillsRepository
            ->add(Argument::type(Skill::class))
            ->shouldBeCalled();

        $responder
            ->skillSuccessfullyAdded(Argument::type(Skill::class))
            ->shouldBeCalled();

        $this->execute(new Command($name = 'PHP'), $responder);
    }
}
