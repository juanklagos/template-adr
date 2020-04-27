<?php

namespace ADR\User\Responder\User;

use ADR\User\Domain\Resources\UserResource;
use App\Domain\Interfaces\ResponderInterface;
use App\Responder\BaseResponder;

class UserViewResponder extends BaseResponder implements ResponderInterface
{
    public function respond()
    {
        return new UserResource($this->response->getData());
    }
}
