<?php

namespace App\Services;

interface UserServiceInterface
{
    public function signIn(array $credentials);

    public function signUp(array $signUpInfo);

    public function verifySignUp(int $userId, String $token);
}
