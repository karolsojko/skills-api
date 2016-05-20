<?php

namespace AppBundle\Controller\Skills;

use FOS\RestBundle\Controller\FOSRestController;
use Domain\UseCase\RemoveSkill\Responder;
use Domain\UseCase\RemoveSkill\Command;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DeleteController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="Delete a skill"
     * )
     */
    public function deleteSkillsAction($slug)
    {
        $useCase = $this->get('app.use_case.remove_skill');
        $useCase->execute(new Command($slug), $this);

        return $this->handleView($this->view);
    }

    public function skillSuccessfullyRemoved($slug)
    {
        $this->view = $this->view(null, 204);
    }

    public function skillNotFound($slug)
    {
        throw $this->createNotFoundException('Skill does not exist');
    }
}
