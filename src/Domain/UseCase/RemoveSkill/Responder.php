<?php

namespace Domain\UseCase\RemoveSkill;

interface Responder
{
    public function skillSuccessfullyRemoved($slug);

    public function skillNotFound($slug);
}
