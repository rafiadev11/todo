<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\RegistrationRequest;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;

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

        public function index()
        {
            return view('auth.register');
        }

        public function register(RegistrationRequest $request)
        {
            $user = $this->user->createUser($request->all());
            Auth::login($user);
            return redirect(route('todo'));
        }
    }
