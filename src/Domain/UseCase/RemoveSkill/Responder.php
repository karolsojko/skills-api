<?php

namespace Domain\UseCase\RemoveSkill;

interface Responder
{
    public function skillSuccessfullyRemoved($id);

    public function skillNotFound($id);
}
