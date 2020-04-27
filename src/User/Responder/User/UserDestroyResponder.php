<?php

namespace ADR\User\Responder\User;

use App\Domain\Interfaces\ResponderInterface;
use App\Responder\BaseResponder;

class UserDestroyResponder extends BaseResponder implements ResponderInterface
{
    public function respond()
    {
        return response()->json(null, 204);
    }
}
