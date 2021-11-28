<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\RegistrationRequest;
    use App\Models\User;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\View\View;

    class RegisterController extends Controller
    {
        /**
         * @var User
         */
        private $user;

        /**
         * @param  User  $user
         */
        public function __construct(User $user)
        {
            $this->user = $user;
        }

        /**
         * get the registration form view
         *
         * @return View
         */
        public function index():View
        {
            return view('auth.register');
        }

        /**
         * Create the user's account
         * Set the role as user
         * Authenticate the user
         *
         * @param  RegistrationRequest  $request
         *
         * @return RedirectResponse
         */
        public function register(RegistrationRequest $request): RedirectResponse
        {
            $user = $this->user->createUser($request->all());
            Auth::login($user);
            return redirect(route('todo'));
        }
    }
