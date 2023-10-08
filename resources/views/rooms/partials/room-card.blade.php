@props([
    'maxWidth' => 'xs',
])
@php
    $maxWidth = [
        'xs' => 'max-w-xs',
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
    ][$maxWidth];
@endphp
<div
    class="{{$maxWidth}} overflow-hidden mx-auto lg:mx-0 rounded-lg shadow-lg bg-white dark:bg-gray-800"
>
    <div
        class="px-4 py-2"
    >
        <h1
            class="text-xl font-bold uppercase text-gray-800 dark:text-white"
        >
            {{$room->name}}
        </h1>
        <p
            class="mt-1 text-sm text-gray-600 dark:text-gray-400"
        >
            {{$room->rate->name}}
        </p>
    </div>

    <a href="{{route('rooms.show', $room->id)}}">
        <img
            class="object-cover w-full h-48 mt-2" src="{{$room->image}}"
            alt="{{$room->name}}"
        >
    </a>

    <div
        class="flex items-center justify-between px-4 py-2 bg-gray-900"
    >
        <h1
            class="text-lg font-bold text-white"
        >
            Вмещает: {{$room->capacity}} чел.
        </h1>
        <div class="flex flex-row justify-between items-center">
            @if(Auth::user()->params()->has('rooms_edit'))
                <a
                    class="mx-2 px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors
                duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none"
                    href="{{route('rooms.edit', $room->id)}}"
                >
                    Редактировать
                </a>
            @endif
        </div>
    </div>
</div>
