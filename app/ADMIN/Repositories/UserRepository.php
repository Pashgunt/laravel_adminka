<?php

namespace App\ADMIN\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function createUser(array $request): int
    {
        return User::create([
            'name' => $request["username"],
            'email' => $request["email"],
            'password' => Hash::make($request["password"]),
        ]);
    }

    public function getAllUsers(): LengthAwarePaginator
    {
        return User::query()->paginate(5);
    }

    public function getUserByEmail(string $email): Collection
    {
        return User::query()->select("*")->where('email', "=", $email)->get();
    }

    public function deleteUser(int $id): int
    {
        return User::query()->where('id', "=", $id)->delete();
    }

    public function updatePasswordForUser(string $email, string $newPassword): int
    {
        $newPassword = Hash::make($newPassword);
        return User::query()
            ->where('email', '=', $email)
            ->update([
                'password' => $newPassword,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
    }

    public function checkIssetUserByEmail(string $email): Collection
    {
        return User::query()->where("email", "=", $email)->get();
    }
}
