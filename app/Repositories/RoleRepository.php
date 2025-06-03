<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepository
{
    public function all()
    {
        return Role::all();
    }

    public function find($id)
    {
        return Role::find($id);
    }

    public function create(array $data)
    {
        $role = Role::create($data);
        if (isset($data['permissions']) && is_array($data['permissions'])) {
            $role->givePermissionTo($this->getPermissionUsingByName($data['permissions']));
        }
    }

    public function update($id, array $data)
    {
        $role = Role::find($id);
        if ($role) {
            $role->update([
                'name' => str_replace(' ', '-', strtolower($data['name']))
            ]);
            if (isset($data['permissions']) && is_array($data['permissions'])) {
                $role->syncPermissions($this->getPermissionUsingByName($data['permissions']));
            }
        }
        return $role;
    }

    public function delete($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return true;
        }
        return false;
    }

    private function getPermissionUsingByName($name): ?array
    {
        $permissions =  Permission::whereIn('id', (array) $name)->pluck('name')->toArray();
        return $permissions;
    }
}
