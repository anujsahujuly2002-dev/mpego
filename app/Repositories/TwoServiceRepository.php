<?php

namespace App\Repositories;

use App\Models\TwoService;


class TwoServiceRepository
{
    /**
     * Create a new TwoService record.
     *
     * @param array $data
     * @return TwoService
     */
    public function create(array $data): TwoService
    {
        return TwoService::create($data);
    }

    /**
     * Find a TwoService by ID.
     *
     * @param int $id
     * @return TwoService|null
     */
    public function find(int $id): ?TwoService
    {
        return TwoService::find($id);
    }

    /**
     * Update a TwoService record.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $service = TwoService::find($id);
        if ($service) {
            return $service->update($data);
        }
        return false;
    }

    /**
     * Delete a TwoService record.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        $service = TwoService::find($id);
        if ($service) {
            return $service->delete();
        }
        return null;
    }


    public function getByUserId($userId)
    {
        return TwoService::where('user_id', $userId)->with(['twoServiceImages'])->first();
    }
}
