<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\View\View;

    class UsersController extends Controller
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
         * get all users with their items
         *
         * @return View
         */
        public function index(): View
        {
            $users = $this->user->with('items')->get();
            return view('admin.index', ['users' => $users]);
        }

        /**
         * get all items by user id
         * get user's deleted items when passing the deleted query parameter
         *
         * @param $userId
         * @param  Request  $request
         *
         * @return View
         */
        public function todos($userId, Request $request): View
        {
            $deleted = $request->has('deleted') && $request->get('deleted') == 1;
            $user = $this->user->getUserItems($userId, $deleted);
            return view('admin.todos', ['user' => $user, 'deleted' => $deleted]);
        }
    }
