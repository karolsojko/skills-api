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
     *     {"name"="type", "dataType"="string", "required"=true, "description"="resource type (video, tutorial, course, etc)"},
     *     {"name"="url", "dataType"="string", "required"=true, "description"="resource url"},
     *     {"name"="description", "dataType"="string", "required"=true, "description"="resource description"},
     *     {"name"="author_id", "dataType"="string", "required"=true, "description"="id of an author that created resource"}
     *   }
     * )
     */
    public function postSkillsResourcesAction($slug, Request $request)
    {
        $useCase = $this->get('app.use_case.add_resource');
        $useCase->execute(
            new Command(
              $slug, $request->get('type'),
              $request->get('url'),
              $request->get('description'),
              $request->get('author_id')
            ),
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
