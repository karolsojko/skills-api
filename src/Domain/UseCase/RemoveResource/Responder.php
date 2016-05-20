<?php

namespace Domain\UseCase\RemoveResource;

interface Responder
{
    public function resourceSuccessfullyRemoved();

    public function skillNotFound();
}
