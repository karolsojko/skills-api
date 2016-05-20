<?php

namespace AppBundle\Controller\Skills\Resources;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Domain\UseCase\AddResource\Responder;
use Domain\UseCase\AddResource\Command;
use Domain\Model\Skill;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CreateController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="Create a resource",
     *   parameters={
     *     {"name"="url", "dataType"="string", "required"=true, "description"="resource url"},
     *     {"name"="description", "dataType"="string", "required"=true, "description"="resource description"}
     *   }
     * )
     */
    public function postSkillsResourcesAction($skillId, Request $request)
    {
        $useCase = $this->get('app.use_case.add_resource');
        $useCase->execute(
            new Command($skillId, $request->get('url'), $request->get('description')),
            $this
        );

        return $this->handleView($this->view);
    }

    public function skillNotFound()
    {
        throw $this->createNotFoundException('Skill not found');
    }

    public function resourceSuccessfullyAdded(Skill $skill)
    {
        $this->view = $this->view($skill);
    }
}
