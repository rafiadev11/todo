<nav class="bg-gray-800">
    <div class="container mx-auto">
        <div class="relative flex items-center justify-between h-16">
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="{{route('todo')}}"
                           class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                           aria-current="page">My Todos</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{route('users')}}"
                               class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                               aria-current="page">Admin Dashboard</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <form action="{{route('logout')}}"
                      method="post">
                    @csrf
                    <button type="submit"
                            class="bg-gray-800 mt-4 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">Logout</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
