<?php

namespace App;

use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    const USERS_INDEX = 'users_index';
    const USERS_STORE = 'users_store';
    const USERS_UPDATE = 'users_update';
    const USERS_DESTROY = 'users_destroy';

    const USERS_INDEX = 'users_index';
    const USERS_STORE = 'users_create';
    const USERS_UPDATE = 'users_update';
    const USERS_DESTROY = 'users_destroy';
/*BODY*/


}
