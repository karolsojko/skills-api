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

    public function addResourceVote($resourceId, ResourceVote $resourceVote) {
        foreach($this->resources as $key => $resource) {
            if ($resource->getId() == $resourceId) {
                foreach($resource->getVotes() as $key => $vote) {
                    if ($vote->getUser() == $resourceVote->getUser()) {
                        // Update the vote count. Remove old vote value and
                        // add new one. If its the same value, there's no change
                        $resource->setVotesTotal($resource->getVotesTotal() + $resourceVote->getVote() - $vote->getVote());
                        $vote->setVote($resourceVote->getVote());
                        return;
                    }
                }
                // If we're here, this is the first vote for the user. Add it.
                $resource->addVote($resourceVote);
                return;
            }
        }
    }
}
