<?php

namespace spec\Domain\UseCase;

use Domain\Model\Resource;
use Domain\Model\Skill;
use Domain\Repository\SkillsRepository;
use Domain\UseCase\AddResource\Command;
use Domain\UseCase\AddResource\Responder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddResourceSpec extends ObjectBehavior
{
    function let(SkillsRepository $skillsRepository)
    {
        $this->beConstructedWith($skillsRepository);
    }

    function it_should_add_a_resource_to_skill_and_notify_the_responder(
        Responder $responder,
        Skill $skill,
        SkillsRepository $skillsRepository
    ) {
        $skillsRepository->findOneBy(['slug' => $slug = 'php'])->willReturn($skill);

        $skill->addResource(Argument::type(Resource::class))->shouldBeCalled();

        $skillsRepository->add($skill)->shouldBeCalled();

        $responder->resourceSuccessfullyAdded($skill)->shouldBeCalled();

        $this->execute(new Command($slug, $type = 'test', $url = 'test', $description = 'test'), $responder);
    }

    function it_should_notify_the_responder_if_skill_is_not_found(
        Responder $responder,
        SkillsRepository $skillsRepository
    ) {
        $skillsRepository->findOneBy(['slug' => $slug = 'php'])->willReturn(null);

        $responder->skillNotFound()->shouldBeCalled();

        $this->execute(new Command($slug, $type = 'test', $url = 'test', $description = 'test'), $responder);
    }
}
