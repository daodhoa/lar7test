<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AuthServiceInterface;

class LoginController extends Controller
{
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function main(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if ($this->authService->login($credentials)) {
            return 'Home Page';
        } else {
            return back()->withInput()->with('error', 'Credentials don\'t match');
        }
    }
}
