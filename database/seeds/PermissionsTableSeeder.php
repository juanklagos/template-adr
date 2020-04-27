<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

// @codingStandardsIgnoreLine
class PermissionsTableSeeder extends Seeder
{
    protected $doctor;
    protected $admin;
    protected $client;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setRoles();

    }

    private function setRoles()
    {
        $this->doctor = Role::firstOrCreate(['name' => Role::DOCTOR]);
        $this->admin = Role::firstOrCreate(['name' => Role::ADMIN]);
        $this->client = Role::firstOrCreate(['name' => Role::CLIENT]);
    }


    private function setUserPermissions()
    {
        $index = Permission::firstOrCreate(['name' => Permission::USERS_INDEX]);
        $create = Permission::firstOrCreate(['name' => Permission::USERS_STORE]);
        $update = Permission::firstOrCreate(['name' => Permission::USERS_UPDATE]);
        $destroy = Permission::firstOrCreate(['name' => Permission::USERS_DESTROY]);

        $this->doctor->givePermissionTo([$index, $create, $update, $destroy]);

        $this->admin->givePermissionTo([$index, $create, $update, $destroy]);

        $this->client->givePermissionTo([$index]);
    }

    
    private function setUserPermissions()
    {
        $index = Permission::firstOrCreate(['name' => Permission::USERS_INDEX]);
        $create = Permission::firstOrCreate(['name' => Permission::USERS_STORE]);
        $update = Permission::firstOrCreate(['name' => Permission::USERS_UPDATE]);
        $destroy = Permission::firstOrCreate(['name' => Permission::USERS_DESTROY]);

        $this->root->givePermissionTo([
            $index,
            $create,
            $update,
            $destroy,
        ]);

        $this->admin->givePermissionTo([
            $index,
            $create,
            $update,
            $destroy,
        ]);
    }

    private function setUserPermissions()
    {
        $index = Permission::firstOrCreate(['name' => Permission::USERS_INDEX]);
        $create = Permission::firstOrCreate(['name' => Permission::USERS_STORE]);
        $update = Permission::firstOrCreate(['name' => Permission::USERS_UPDATE]);
        $destroy = Permission::firstOrCreate(['name' => Permission::USERS_DESTROY]);

        $this->root->givePermissionTo([
            $index,
            $create,
            $update,
            $destroy,
        ]);

        $this->admin->givePermissionTo([
            $index,
            $create,
            $update,
            $destroy,
        ]);
    }
/*BODY*/


}
