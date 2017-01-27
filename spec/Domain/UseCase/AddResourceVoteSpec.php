<?php

namespace spec\Domain\UseCase;

use Domain\Model\ResourceVotes;
use Domain\Model\Resource;
use Domain\Model\Skill;
use Domain\Repository\SkillsRepository;
use Domain\UseCase\AddResourceVote\Command;
use Domain\UseCase\AddResourceVote\Responder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddResourceVoteSpec extends ObjectBehavior
{
    function let(SkillsRepository $skillsRepository)
    {
        $this->beConstructedWith($skillsRepository);
    }

    function it_should_add_a_resource_vote_to_resource_and_notify_the_responder(
        Responder $responder,
        Skill $skill,
        Resource $resource,
        SkillsRepository $skillsRepository
    ) {
        $skillsRepository->findOneBy(['slug' => $slug = 'php'])->willReturn($skill);

        $skill->addResourceVote(Argument::type(ResourceVote::class))->shouldBeCalled();

        $skillsRepository->add($skill)->shouldBeCalled();

        $responder->resourceVoteSuccessfullyAdded($skill)->shouldBeCalled();

        $this->execute(new Command($slug, $resource, $user = 'test', $vote = 1), $responder);
    }

    function it_should_notify_the_responder_if_skill_is_not_found(
        Responder $responder,
        SkillsRepository $skillsRepository
    ) {
        $skillsRepository->findOneBy(['slug' => $slug = 'php'])->willReturn(null);

        $responder->skillNotFound()->shouldBeCalled();

        $this->execute(new Command($slug, $resource, $user = 'test', $vote = 1), $responder);
    }
}
