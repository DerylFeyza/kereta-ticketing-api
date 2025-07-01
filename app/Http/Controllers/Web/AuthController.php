<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class AuthController extends Controller
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            switch ($user->role) {
                case 'petugas':
                    return redirect()->route('admin.dashboard');
                default:
                    return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $user = $this->userService->createPelanggan($request);
        if (!$user) {
            return back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('user.dashboard');
    }
}
