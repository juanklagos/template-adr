<?php

namespace ADR\User\Domain\Services\User;

use ADR\User\Domain\Interfaces\Repositories\UserRepository;
use App\Domain\Interfaces\ServiceInterface;
use App\Domain\Payloads\SuccessPayload;

class UserDestroyService implements ServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle($attributes = [], int $id = null)
    {
        $user = $this->userRepository->delete($id);

        return new SuccessPayload($user);
    }
}
