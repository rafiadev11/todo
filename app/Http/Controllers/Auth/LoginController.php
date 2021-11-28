<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;

    class LoginController extends Controller
    {
        public function index()
        {
            return view('auth.login');
        }

        public function login(Request $request)
        {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $rememberMe = false;
            if ($request->has('remember-me') && $request->get('remember-me') === 'on') {
                $rememberMe = true;
            }
            if (Auth::attempt([
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ], $rememberMe)) {
                $request->session()->regenerate();
                return redirect()->intended(route('todo'));
            }
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('login'));
        }
    }
