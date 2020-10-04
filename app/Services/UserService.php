<?php

namespace App\Services;

use App\Mail\VerifySignUp;
use App\Model\User;
use App\Repository\UserRepository;
use App\Repository\UserVerificationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService implements UserServiceInterface
{
    private $userRepository;
    private $userVerificationRepository;

    public function __construct(UserRepository $userRepository,
                                UserVerificationRepository $userVerificationRepository)
    {
        $this->userRepository = $userRepository;
        $this->userVerificationRepository = $userVerificationRepository;
    }

    public function signIn(array $credentials)
    {
        $token = Auth::attempt($credentials);
        if (!$token) {
            return [
                'status' => false,
                'data' => [
                    'error' => 'Wrong credentials'
                ]
            ];
        }

        $user = Auth::user();
        if (!$user->is_verified) {
            return [
                'status' => false,
                'data' => [
                    'error' => 'User has not been verified'
                ]
            ];
        }
        return [
            'status' => true,
            'data' => [
                'access_token' => $token,
                'email' => $user->email,
                'name' => $user->name
            ]
        ];
    }

    public function signUp(array $signUpInfo)
    {
        $user = $this->userRepository->findByEmail($signUpInfo['email']);
        if ($user) {
            if ($user->is_verified) {
                return [
                    'status' => false,
                    'data' => [
                        'error' => 'Email existed'
                    ]
                ];
            } else {
                $this->sendVerificationCode($user);
                return [
                    'status' => true,
                    'data' => [
                        'message' => 'Check email'
                    ]
                ];
            }
        }
        $user = $this->userRepository->create([
            'name' => $signUpInfo['name'],
            'email' => $signUpInfo['email'],
            'password' => Hash::make($signUpInfo['password']),
            'is_verified' => 0,
            'lang' => $signUpInfo['lang'],
            'username' => $signUpInfo['email']
        ]);
        $this->sendVerificationCode($user);
        return [
            'status' => true,
            'data' => [
                'message' => 'Check email'
            ]
        ];
    }

    private function sendVerificationCode(User $user) {
        $str = rand();
        $token = md5($user->email . $str);
        $this->userVerificationRepository->create([
            'user_id' => $user->id,
            'token' => $token
        ]);
        $link = env('APP_URL').'/api/v1/auth/verify/'.$user->id.'/'.$token;
        Mail::to($user)->send(new VerifySignUp($link));
    }

    public function verifySignUp(int $userId, string $token)
    {
        $user = $this->userRepository->find($userId);
        if (!$user || $user->is_verified ==  \App\Enums\User::VERIFIED) {
            return [
                'status' => false,
                'data' => [
                    'error' => 'Invalid user'
                ]
            ];
        }
        $userVerification = $this->userVerificationRepository->getLastUserVerifications($userId);
        if ($userVerification && $userVerification->token == $token) {
            $this->userRepository->update($userId, [
               'is_verified' => \App\Enums\User::VERIFIED
            ]);
            return [
                'status' => false,
                'data' => [
                    'message' => 'Successfully'
                ]
            ];
        }
        return [
            'status' => false,
            'data' => [
                'error' => 'Invalid user'
            ]
        ];
    }
}
