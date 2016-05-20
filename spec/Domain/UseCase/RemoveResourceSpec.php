<?php

namespace spec\Domain\UseCase;

use Domain\Model\Skill;
use Domain\Repository\SkillsRepository;
use Domain\UseCase\RemoveResource\Command;
use Domain\UseCase\RemoveResource\Responder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoveResourceSpec extends ObjectBehavior
{
    function let(SkillsRepository $skillsRepository)
    {
        $this->beConstructedWith($skillsRepository);
    }

    function it_should_remove_resource_and_notify_responder(
        SkillsRepository $skillsRepository,
        Skill $skill,
        Responder $responder
    ) {
        $skillsRepository->find($skillId = 1)->willReturn($skill);

        $skill->removeResource($resourceId = 2)->shouldBeCalled();

        $skillsRepository->add($skill)->shouldBeCalled();

        $responder->resourceSuccessfullyRemoved()->shouldBeCalled();

        $this->execute(new Command($skillId, $resourceId), $responder);
    }
}
