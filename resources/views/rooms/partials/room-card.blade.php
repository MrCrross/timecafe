@props([
    'maxWidth' => 'xs',
    'welcome' => false,
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

    $bgColor = 'bg-white dark:bg-gray-800';
    $textColor = 'text-gray-800 dark:text-white';
    if ($welcome) {
        $bgColor = 'bg-gold dark:bg-dark';
        $textColor = 'text-gray-800 dark:text-gold';
    }
@endphp
<div
    class="{{$maxWidth}} overflow-hidden mx-auto lg:mx-0 rounded-lg shadow-lg {{$bgColor}}"
>
    <div
        class="px-4 py-2"
    >
        <a href="{{$welcome ? '#room' : route('rooms.show', $room->id)}}">
            <h1
                class="text-xl font-bold uppercase {{$textColor}}"
            >
                {{$room->name}}
            </h1>
        </a>
        <p
            class="mt-1 text-sm text-gray-600 dark:text-gray-400"
        >
            {{$room->rate->name}}
        </p>
    </div>


    <img
        class="object-cover w-full h-48 mt-2" src="{{$room->image}}"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'modal_Image{{$room->id}}')"
        alt="{{$room->name}}"
    >


    <div
        class="flex items-center justify-between px-4 py-2 bg-gray-900"
    >
        <h1
            class="text-lg font-bold text-white"
        >
            Вмещает: {{$room->capacity}} чел.
        </h1>
        <div class="flex flex-row justify-between items-center">
            @auth
                @if(Auth::user()->params()->has('rooms_edit'))
                    <a
                        class="mx-2 px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors
                    duration-300 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none"
                        href="{{route('rooms.edit', $room->id)}}"
                    >
                        Редактировать
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div>
<x-modal id="modal_Image{{$room->id}}" name="modal_Image{{$room->id}}" focusable>
    <div class="flex flex-row justify-center items-center m-4">
        <img
            src="{{$room->image}}"
            alt="{{$room->name}}"
        >
    </div>

    <div class="m-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Отмена') }}
        </x-secondary-button>
    </div>
</x-modal>
