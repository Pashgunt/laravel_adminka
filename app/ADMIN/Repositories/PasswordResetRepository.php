<?php

namespace App\ADMIN\Repositories;

use App\Models\PasswordReset;
use Illuminate\Database\Eloquent\Collection;

class PasswordResetRepository
{

    public function addAccessTokenForRecovery(string $email, string $accessToken): bool
    {
        return PasswordReset::query()->insert([
            'email' => $email,
            'token' => $accessToken
        ]);
    }

    public function checkIssetAccessToken(string $accessToken): Collection
    {
        return PasswordReset::query()->select("email")->where("token", "=", $accessToken)->get();
    }

    public function deleteAccessTokenByEmailAddress(string $email)
    {
        return PasswordReset::query()->where('email', '=', $email)->delete();
    }

    public function checkIssetTokenByEmail(string $email): Collection
    {
        return PasswordReset::query()->where('email', '=', $email)->get();
    }
}
