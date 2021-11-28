<x-layouts.user>
    <x-slot name="title">{{$user->name}}</x-slot>
    <div class="max-w-4xl mx-auto mt-5">
        <h1 class="mt-6 text-3xl font-extrabold text-gray-900">{{$user->name}} Todo
                                                                               List {{$deleted?'[Deleted]':''}}</h1>
        @if(count($user->items) < 1)
            <h2 class="text-center text-xl mt-5"><em>No Items Found</em></h2>
        @else
            @foreach($user->items as $todo)
                <div class="flex mb-4 mt-5 items-center">
                    <p class="w-full {{$deleted?'text-red-400':'text-grey-darkest'}} {{$todo->completed_at?'line-through':''}}">{{$todo->name}}</p>
                    <p class="w-full text-right">
                        <span class="{{$deleted?'text-red-400':'text-green-400'}} underline">{{$todo->completed_at}}</span>
                    </p>
                </div>
            @endforeach
        @endif
    </div>
</x-layouts.user>
