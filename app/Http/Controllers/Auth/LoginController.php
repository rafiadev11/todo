<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Validation\ValidationException;
    use Illuminate\View\View;

    class LoginController extends Controller
    {
        /**
         * get the login form view
         *
         * @return View
         */
        public function index():View
        {
            return view('auth.login');
        }

        /**
         * Authenticate the user
         *
         * @param  Request  $request
         *
         * @return RedirectResponse
         * @throws ValidationException
         */
        public function login(Request $request): RedirectResponse
        {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $rememberMe = $request->has('remember-me') && $request->get('remember-me') === 'on';
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

        /**
         * Log the user out
         *
         * @param  Request  $request
         *
         * @return RedirectResponse
         */
        public function logout(Request $request):RedirectResponse
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('login'));
        }
    }
