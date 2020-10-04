<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function signIn(Request $request)
    {
        $this->validateSignInRequest($request);
        $credentials = $request->only(['email', 'password']);
        $responseData = $this->userService->signIn($credentials);
        return response()->json($responseData['data'], $responseData['status'] ? 200 : 401);
    }

    private function validateSignInRequest(Request $request) {
        return $request->validate([
           'email' => 'required|string|email',
           'password' => 'required|string|min:6'
        ]);
    }

    public function signUp(Request $request) {
        $this->validateSignUpRequest($request);
        $signUpInfo = $request->only(['email', 'password', 'name', 'lang']);
        $responseData = $this->userService->signUp($signUpInfo);
        return response()->json($responseData['data'], $responseData['status'] ? 200 : 401);
    }

    private function validateSignUpRequest(Request $request)
    {
        return $request->validate([
            'email' => 'required|string|email',
            'name' => 'required|string|min:2',
            'password' => 'required|string|min:6|confirmed',
            'lang' => 'required|in:en,vn'
        ]);
    }

    public function verifySignUp(Request $request, $id, $token)
    {
        if (!$id || !$token) {
            return response()->json('Not found', 401);
        }
        $responseData = $this->userService->verifySignUp($id, $token);
        return response()->json($responseData['data'], $responseData['status'] ? 200 : 401);
    }

    public function signOut(Request $request) {
        Auth::logout();
        return response()->json(['message' => 'Logout'], 200);
    }

    public function getMe(Request $request) {
        return response()->json(Auth::user(), 200);
    }
}
