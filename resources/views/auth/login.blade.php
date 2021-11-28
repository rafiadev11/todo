<x-layouts.auth>
    <x-slot name="title">Login</x-slot>
    <x-cards.card>
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Sign in to your account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Or
                <a href="{{route('register')}}"
                   class="font-medium text-indigo-600 hover:text-indigo-500">
                    create a new account
                </a>
            </p>
        </div>
        @if($errors->any())
            <x-cards.error>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </x-cards.error>
        @endif
        <form class="mt-8 space-y-6"
              action="{{route('loginUser')}}"
              method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email-address"
                           class="sr-only">Email address</label>
                    <input id="email-address"
                           name="email"
                           type="email"
                           autocomplete="email"
                           required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Email address">
                </div>
                <div>
                    <label for="password"
                           class="sr-only">Password</label>
                    <input id="password"
                           name="password"
                           type="password"
                           autocomplete="current-password"
                           required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Password">
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me"
                           name="remember-me"
                           type="checkbox"
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember-me"
                           class="ml-2 block text-sm text-gray-900">
                        Remember me
                    </label>
                </div>
            </div>
            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Sign in
                </button>
            </div>
        </form>
    </x-cards.card>
</x-layouts.auth>
