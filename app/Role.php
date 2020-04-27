<?php

namespace App;

use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    const DOCTOR = 'doctor';
    const ADMIN = 'admin';
    const CLIENT = 'client';
}
