<?php

namespace AppBundle\Controller\Skills;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Domain\UseCase\AddSkill\Responder;
use Domain\UseCase\AddSkill\Command;
use Domain\Model\Skill;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CreateController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="Create a skill",
     *   parameters={
     *     {"name"="name", "dataType"="string", "required"=true, "description"="skill name"}
     *   }
     * )
     */
    public function postSkillsAction(Request $request)
    {
        $useCase = $this->get('app.use_case.add_skill');
        $useCase->execute(new Command($request->get('name')), $this);

        return $this->handleView($this->view);
    }

    public function skillSuccessfullyAdded(Skill $skill)
    {
        $this->view = $this->view($skill);
    }

    public function skillAlreadyExists(Skill $skill)
    {
        $this->view = $this->view($skill, 409);
    }
}
