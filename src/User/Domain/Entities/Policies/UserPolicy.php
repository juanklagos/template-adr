<?php

namespace ADR\User\Domain\Entities\Policies;

use ADR\User\Domain\Entities\User;
use ADR\User\Domain\Entities\User;
use ADR\Permission\Domain\Entities\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list user.
     *
     * @param  \ADR\User\Domain\Entities\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->can(Permission::USERS_INDEX);
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \ADR\User\Domain\Entities\User  $user
     * @param  \ADR\User\Domain\Entities\User  $user
     * @return mixed
     */
    public function view(User $user, User $user)
    {
        return $user->can(Permission::USERS_INDEX);
    }

    /**
     * Determine whether the user can store user.
     *
     * @param  \ADR\User\Domain\Entities\User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->can(Permission::USERS_STORE);
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \ADR\User\Domain\Entities\User  $user
     * @param  \ADR\User\Domain\Entities\User  $user
     * @return mixed
     */
    public function update(User $user, User $user)
    {
        return $user->can(Permission::USERS_UPDATE);
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \ADR\User\Domain\Entities\User  $user
     * @param  \ADR\User\Domain\Entities\User  $user
     * @return mixed
     */
    public function delete(User $user, User $user)
    {
        return $user->can(Permission::USERS_DESTROY);
    }
}
