<?php

namespace AppBundle\Controller\Skills\Resources\ResourceVotes;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Domain\UseCase\AddResourceVote\Responder;
use Domain\UseCase\AddResourceVote\Command;
use Domain\Model\Skill;
use Domain\Model\Resource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CreateController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="Create a resource vote",
     *   parameters={
     *     {"name"="user", "dataType"="string", "required"=true, "description"="User ID voting"},
     *     {"name"="vote", "dataType"="integer", "required"=true, "description"="Vote. 1=upvote, -1=downvote"}
     *   }
     * )
     */
    public function postSkillsResourceVotesAction($slug, $resource_id, Request $request)
    {
        $useCase = $this->get('app.use_case.add_resource_vote');
        $useCase->execute(
            new Command($slug, $resource_id, $request->get('user'), $request->get('vote')),
            $this
        );

        return $this->handleView($this->view);
    }

    public function skillNotFound()
    {
        throw $this->createNotFoundException('Skill not found');
    }

    public function resourceNotFound()
    {
        throw $this->createNotFoundException('Resource not found');
    }

    public function resourceVoteSuccessfullyAdded(Skill $skill)
    {
        $this->view = $this->view($skill);
    }
}
