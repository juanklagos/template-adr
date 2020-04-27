<?php

namespace ADR\User\Domain\Repositories;

use ADR\User\Domain\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use ADR\User\Domain\Interfaces\Repositories\UserRepository;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace ADR\User\Domain\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
