<?php

namespace ADR\User\Domain\Services\User;

use ADR\User\Domain\Interfaces\Repositories\UserRepository;
use App\Domain\Interfaces\ServiceInterface;
use App\Domain\Payloads\SuccessPayload;
use Prettus\Repository\Criteria\RequestCriteria;

class UserListService implements ServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle($attributes = [], int $id = null)
    {
        $this->userRepository->pushCriteria(app(RequestCriteria::class));
        return new SuccessPayload($this->userRepository->paginate($attributes['size'] ?? null));
    }
}
