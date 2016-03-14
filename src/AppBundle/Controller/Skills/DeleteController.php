<?php

namespace AppBundle\Controller\Skills;

use FOS\RestBundle\Controller\FOSRestController;
use Domain\UseCase\RemoveSkill\Responder;
use Domain\UseCase\RemoveSkill\Command;
use Domain\Model\Skill;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DeleteController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="Delete a skill",
     *   parameters={
     *     {"name"="id", "dataType"="string", "description"="skill id"}
     *   }
     * )
     */
    public function deleteSkillsAction($id)
    {
        $useCase = $this->get('app.use_case.remove_skill');
        $useCase->execute(new Command($id), $this);

        return $this->handleView($this->view);
    }

    public function skillSuccessfullyRemoved($id)
    {
        $this->view = $this->view(null, 204);
    }

    public function skillNotFound($id)
    {
        throw $this->createNotFoundException('Skill does not exist');
    }
}
