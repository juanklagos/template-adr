<?php

namespace ADR\User\Responder\User;

use ADR\User\Domain\Resources\UserResource;
use App\Domain\Interfaces\ResponderInterface;
use App\Domain\Payloads\ValidationFailedPayload;
use App\Responder\BaseResponder;

class UserListResponder extends BaseResponder implements ResponderInterface
{
    public function respond()
    {
        if ($this->response instanceof ValidationFailedPayload) {
            return response()->json($this->response->getData(), $this->response->getStatus());
        }

        return UserResource::collection($this->response->getData());
    }
}
