<?php

namespace Domain\UseCase\ListSkills;

interface Responder
{
    public function skillsSuccessfullyRetrieved($skills);
}
