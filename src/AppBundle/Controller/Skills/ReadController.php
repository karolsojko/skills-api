<?php

namespace AppBundle\Controller\Skills;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Domain\UseCase\ListSkills\Responder;
use Domain\UseCase\ListSkills\Command;
use Domain\Model\Skill;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ReadController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="List of skills"
     * )
     */
    public function getSkillsAction()
    {
        $useCase = $this->get('app.use_case.list_skills');
        $useCase->execute(new Command(), $this);

        return $this->handleView($this->view);
    }

    public function skillsSuccessfullyRetrieved($skills)
    {
        $this->view = $this->view($skills);
    }
}
