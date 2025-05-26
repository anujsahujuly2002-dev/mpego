<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    /**
     * Get all permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Permission::all();
    }

    /**
     * Find a permission by ID.
     *
     * @param  int  $id
     * @return Permission|null
     */
    public function find($id)
    {
        return Permission::find($id);
    }

    /**
     * Create a new permission.
     *
     * @param  array  $data
     * @return Permission
     */
    public function create(array $data)
    {
        return Permission::create($data);
    }

    /**
     * Update a permission.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool
     */
    public function update($id, array $data)
    {
        $permission = $this->find($id);
        if ($permission) {
            return $permission->update($data);
        }
        return false;
    }

    /**
     * Delete a permission.
     *
     * @param  int  $id
     * @return bool|null
     */
    public function delete($id)
    {
        $permission = $this->find($id);
        if ($permission) {
            return $permission->delete();
        }
        return false;
    }
}
