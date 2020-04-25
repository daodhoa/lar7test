<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function main()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
