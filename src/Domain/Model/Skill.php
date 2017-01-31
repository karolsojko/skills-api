<?php

namespace Domain\Model;

use Ramsey\Uuid\Uuid;

class Skill
{
    private $id;
    private $name;
    private $slug;
    private $resources;

    public function __construct($name, $slug)
    {
        $uuid = Uuid::uuid4();
        $this->id = $uuid->toString();
        $this->name = $name;
        $this->slug = $slug;
        $this->resources = [];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function addResource(Resource $resource)
    {
        $this->resources[] = $resource;
    }

    public function removeResource($resourceId)
    {
        foreach($this->resources as $key => $resource) {
            if ($resource->getId() == $resourceId) {
                unset($this->resources[$key]);
            }
        }
    }

    public function getResource($resourceId) {
        foreach($this->resources as $key => $resource) {
          if ($resource->getId() == $resourceId) {
            return $resource;
          }
        }
        return false;
    }

    public function addResourceVote($resourceId, ResourceVote $resourceVote) {
        if ($resource = $this->getResource($resourceId)) {
            if ($vote = $resource->getVoteByUser($resourceVote->getUser())) {
              $resource->setVotesTotal($resource->getVotesTotal() + $resourceVote->getValue() - $vote->getValue());
              $vote->setValue($resourceVote->getValue());
            }
            else {
              $resource->addVote($resourceVote);
            }
        }
    }
}
