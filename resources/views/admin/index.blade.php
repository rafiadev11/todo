<x-layouts.user>
    <x-slot name="title">Users Todo List</x-slot>
    <div class="max-w-4xl mx-auto mt-5">
        <h1 class="mt-6 text-3xl font-extrabold text-gray-900">Users' Todo List</h1>
        @foreach($users as $user)
            <div class="flex mb-4 mt-5 items-center">
                <p class="w-full text-grey-darkest">{{$user->name}}</p>
                <p class="w-full text-right"><a href="{{route('user.todos',['id'=>$user->id])}}" class="text-green-400 underline">Items ({{count($user->items)}})</a></p>
                <p class="w-full text-right"><a href="{{route('user.todos',['id'=>$user->id,'deleted'=>'1'])}}" class="text-red-400 underline">Deleted Items</a></p>
            </div>
        @endforeach
    </div>
</x-layouts.user>
