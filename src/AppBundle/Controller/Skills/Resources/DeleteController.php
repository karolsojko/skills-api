<?php

namespace AppBundle\Controller\Skills\Resources;

use FOS\RestBundle\Controller\FOSRestController;
use Domain\UseCase\RemoveResource\Responder;
use Domain\UseCase\RemoveResource\Command;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DeleteController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="Delete a resource"
     * )
     */
    public function deleteSkillsResourcesAction($slug, $resourceId)
    {
        $useCase = $this->get('app.use_case.remove_resource');
        $useCase->execute(new Command($slug, $resourceId), $this);

        return $this->handleView($this->view);
    }

    public function skillNotFound()
    {
        throw $this->createNotFoundException('Skill does not exist');
    }

    public function resourceSuccessfullyRemoved()
    {
        $this->view = $this->view(null, 204);
    }
}
