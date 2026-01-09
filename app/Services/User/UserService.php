<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected array $allowedFields = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
    ];

    public function getUsersWithRoles(int $perPage = 10): LengthAwarePaginator
    {
        return User::with('role')
            ->orderBy('name')
            ->paginate($perPage);
    }

    public function create(array $data): User
    {
        $data = $this->filterData($data);
        $data['password'] = Hash::make($data['password']);

        return DB::transaction(fn () => User::create($data));
    }

    public function update(User $user, array $data): User
    {
        $data = $this->filterData($data);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return DB::transaction(function () use ($user, $data) {
            $user->update($data);
            return $user->refresh();
        });
    }

    public function delete(User $user): void
    {
        DB::transaction(fn () => $user->delete());
    }

    protected function filterData(array $data): array
    {
        return array_intersect_key(
            $data,
            array_flip($this->allowedFields)
        );
    }
}
